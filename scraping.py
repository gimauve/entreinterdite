import wikipediaapi
import requests
import pandas as pd
from bs4 import BeautifulSoup
import json
import numpy as np


def check_droit(url):
# get the response in the form of html
	table_class="wikitable sortable jquery-tablesorter"
	response=requests.get(url)
	if response.status_code==200:
		return response
	else:
		return False


# parse data from the html into a beautifulsoup object
def taux_homicide_monde(url):
	url=check_droit(url)
	if url==False:
		print("Nous n'avons pas le droit de scrapper cette page")
		return False
	else:
		soup = BeautifulSoup(url.text, 'html.parser')
		indiatable=soup.find('table',{'class':"wikitable sortable static-row-numbers plainrowheaders srn-white-background"})
		df=pd.read_html(str(indiatable))
		# convert list to dataframe
		df=pd.DataFrame(df[0])
		df.drop(["Source","Year","Subregion","Region","Count"], inplace=True, axis=1)
		df.drop(0,inplace=True,axis=0)
		#print(df)
		return df


def pourcent_catastrophes_monde(url):
	url=check_droit(url)
	if url==False:
		print("Nous n'avons pas le droit de scrapper cette page")
		return False
	else:
		soup = BeautifulSoup(url.text, 'html.parser')
		indiatable=soup.find('table',{'class':"wikitable sortable"})
		df=pd.read_html(str(indiatable))
		# convert list to dataframe
		df=pd.DataFrame(df[0])
		df.drop(["2013[4]","2012[5]","2011[6]"], inplace=True, axis=1)
		#print(df)
		return df
url_homicide="https://en.wikipedia.org/wiki/List_of_countries_by_intentional_homicide_rate"
url_cata="https://en.wikipedia.org/wiki/List_of_countries_by_natural_disaster_risk"
df=taux_homicide_monde(url_homicide)
print(taux_homicide_monde(url_homicide))
#print(pourcent_catastrophes_monde(url_cata))
#print(df["Location"])
for i in range (len(df["Location"])):
	if "*" in df["Location"].iloc[i]:
		remplacement=df["Location"].iloc[i]
		df.replace(remplacement,remplacement[:-2], inplace=True)
#print(df)
homicides_json=df.to_json()
catastrophes_json=pourcent_catastrophes_monde(url_cata).to_json()

with open('data_homicide.json', 'w') as data:
	json.dump(homicides_json,data)

with open('data_catastrophes.json', 'w') as data:
	json.dump(catastrophes_json,data)