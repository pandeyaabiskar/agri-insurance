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


def process_data():
    data = pd.read_csv(
        'D:\Blockchain\AgroChain Project\Climate Analysis\data\data.csv')
    data.drop_duplicates(subset=["DISTRICT"]).to_csv(
        'D:\Blockchain\AgroChain Project\Climate Analysis\district.csv')
    # for district in data.DISTRICT.unique():
    #     data.loc[(data['DISTRICT'] == district)].to_csv(
    #         'D:\Blockchain\AgroChain Project\Climate Analysis\data\climate_data_nepal_' + district + '_monthly.csv')
    # return data


process_data()
