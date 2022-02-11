import pandas as pd
import numpy as np
from scipy import stats as st
import sys
# import matplotlib.pyplot as plt
# import matplotlib.dates as mdates


pd.set_option('display.max_rows', None)
pd.set_option('display.max_columns', None)
pd.set_option('display.width', None)
pd.set_option('display.max_colwidth', None)

# Standardized Precipitation Index Function


def spi(ds, thresh):
    # ds - data ; thresh - time interval / scale

    # Rolling Mean / Moving Averages
    ds_ma = ds.rolling(thresh, center=False).mean()

    # Natural log of moving averages
    ds_In = np.log(ds_ma, where=ds_ma > 0)
    ds_In[np.isinf(ds_In) == True] = np.nan  # Change infinity to NaN

    # Overall Mean of Moving Averages
    ds_mu = np.nanmean(ds_ma)

    # Summation of Natural log of moving averages
    ds_sum = np.nansum(ds_In)

    # Computing essentials for gamma distribution
    n = len(ds_In[thresh-1:])  # size of data
    A = np.log(ds_mu) - (ds_sum/n)  # Computing A
    alpha = (1/(4*A))*(1+(1+((4*A)/3))**0.5)  # Computing alpha  (a)
    beta = ds_mu/alpha  # Computing beta (scale)

    # Gamma Distribution (CDF)
    gamma = st.gamma.cdf(ds_ma, a=alpha, scale=beta)

    # Standardized Precipitation Index   (Inverse of CDF)
    # loc is mean and scale is standard dev.
    norm_spi = st.norm.ppf(gamma, loc=0, scale=1)

    return ds_ma, ds_In, ds_mu, ds_sum, n, A, alpha, beta, gamma, norm_spi


def call_spi(district):
    data = pd.read_csv(
        'D:\Blockchain\AgroChain Project\Climate Analysis\data\climate_data_nepal_district_wise_monthly.csv')
    data = data.loc[(data['DISTRICT'] == district)]
    times = [1, 3]
    for i in times:
        x = spi(data['PRECTOT'], i)
        data['spi_'+str(i)] = x[9]
    data, data.columns = data[1:], data.iloc[0]
    data = data.transpose()
    data.to_csv(
        'D:\Blockchain\AgroChain Project\Climate Analysis\spi_full_output\output' + district + '.csv')
    return data


call_spi(str(sys.argv[1]))
