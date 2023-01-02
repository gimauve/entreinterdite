import requests
import pandas as panda
from bs4 import BeautifulSoup
import json



def check_right(url):
	response=requests.get(url)
	if response.status_code==200:
		return response
	else:
		raise Exception("BAD STATUS")

def cutStar(table):
	for i in range (len(table["Location"])):
		if("*" in str(table["Location"].iloc[i])):
			table.replace(table["Location"].iloc[i],table["Location"].iloc[i][:-2], inplace=True)
	return table

def getPandaTablesFromResponse(res):
	parser = BeautifulSoup(res.text, 'html.parser')
	allTable = parser.find_all('table')

	allTablePanda= panda.read_html(str(allTable))

	for i in range(len(allTablePanda)):
		allTablePanda[i] = panda.DataFrame(allTablePanda[i])
	
	return allTablePanda

def getGreatTableWithIndex(index,allTablePanda):
	result = []
	for i in range(len(allTablePanda)):
		boolean = all(item in allTablePanda[i] for item in index)
		if(boolean):
			result.append(allTablePanda[i])
	return result

def homicide_rate_world(res):

	allTablePanda = getPandaTablesFromResponse(res)
	
	greatTable = getGreatTableWithIndex(["Region","Location","Source","Year","Subregion","Region","Count","Rate"],allTablePanda)[0]
	greatTable.drop(["Source","Year","Subregion","Region","Count"], inplace=True, axis=1)
	greatTable.drop(0,inplace=True,axis=0)

	cutStar(greatTable)

	return greatTable.to_json()

def homicide_rate_us(res):

	allTablePanda = getPandaTablesFromResponse(res)
	
	greatTable = getGreatTableWithIndex(["2020","Historical Violent Crime Rates","State or Territory"],allTablePanda)[0]

	greatTable.drop(["Historical Violent Crime Rates"], inplace=True, axis=1)
	greatTable.drop(0,inplace=True,axis=0)
	
	return greatTable.to_json()


def percentage_naturalDisasters_world(res):

	allTablePanda = getPandaTablesFromResponse(res)
	greatTable = allTablePanda[0]
	greatTable.drop(["2013[4]","2012[5]","2011[6]"], inplace=True, axis=1)

	return greatTable.to_json()

def naturalDisasters_us(res):

	allTablePanda = getPandaTablesFromResponse(res)
	greatTable = getGreatTableWithIndex(["Year","Disaster","Death toll","Location"],allTablePanda)[0]

	greatTable.drop(["Notes","Main article","Damage cost US$","Year"], inplace=True, axis=1)
	return greatTable.to_json()



res = check_right("https://en.wikipedia.org/wiki/List_of_countries_by_intentional_homicide_rate")
res2 = check_right("https://en.wikipedia.org/wiki/List_of_countries_by_natural_disaster_risk")
res3 = check_right("https://en.wikipedia.org/wiki/List_of_U.S._states_and_territories_by_violent_crime_rate")
res4 = check_right("https://en.wikipedia.org/wiki/List_of_natural_disasters_in_the_United_States")

hrw = homicide_rate_world(res)
pndw = percentage_naturalDisasters_world(res2)
hrUS = homicide_rate_us(res3)
pndUS = naturalDisasters_us(res4)

with open('data_homicide.json', 'w') as data:
	json.dump(hrw,data)

with open('data_catastrophes.json', 'w') as data:
	json.dump(pndw,data)

with open('data_homicides_us.json', 'w') as data:
	json.dump(hrUS,data)

with open('data_catastrophes_us.json', 'w') as data:
	json.dump(pndUS,data)