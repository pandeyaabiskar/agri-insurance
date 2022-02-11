import pandas as pd
import numpy as np
from scipy import stats as st
import csv
import itertools
import sys

from sqlalchemy import false
# import matplotlib.pyplot as plt
# import matplotlib.dates as mdates


pd.set_option('display.max_rows', None)
pd.set_option('display.max_columns', None)
pd.set_option('display.width', None)
pd.set_option('display.max_colwidth', None)


def generate_average():
    data = pd.read_csv(
        'D:\Blockchain\AgroChain Project\Climate Analysis\daily_data\data.csv')
    aggregation_functions = {'DATE': 'last',
                             'YEAR': 'last', 'MONTH': 'last', 'PRECTOT': 'sum'}
    data_new = data.groupby(data['DISTRICT'], as_index=False).aggregate(
        aggregation_functions)
    data_new = data_new[['DATE', 'YEAR', 'MONTH', 'DISTRICT', 'PRECTOT']]
    data_new.to_csv(
        'D:\Blockchain\AgroChain Project\Climate Analysis\daily_data\sum.csv', index=False, header=False)
    file_in = 'D:\Blockchain\AgroChain Project\Climate Analysis\daily_data\sum.csv'
    file_out = 'D:\Blockchain\AgroChain Project\Climate Analysis\data\climate_data_nepal_district_wise_monthly.csv'
    with open(file_in, "r", newline='') as f_input, \
            open(file_out, "a", newline='') as f_output:

        csv_input = csv.reader(f_input)
        for x in range(62):
            csv.writer(f_output).writerows(itertools.islice(csv_input, x))


generate_average()
