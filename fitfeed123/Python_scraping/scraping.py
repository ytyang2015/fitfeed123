import json 
import requests 
import urllib 
import sys 
from bs4 import BeautifulSoup
import csv
f = open ('food.txt','r')
line = f.readlines()
for foodname in line:
	try:
		foodname = foodname.replace('\n','')
		url = 'http://www.myfitnesspal.com/food/search'
		param = { 'utf8': '%E2%9C%93','authenticity_token':'j5ERIYbWCivVASr8Ziao7G3mKGcNhPFrfSndt66wdGY=','search': foodname,'commit':'Search'}
		query = requests.post(url,data=param)
		htmlObj = BeautifulSoup(query.text,"html.parser")
		hrefLink = htmlObj.find("div",{"class":"food_description"}).a
		foodlink = 'http://www.myfitnesspal.com'+hrefLink['href']
# get the stupid weight ID!!!!!!!!!!!!

		testest = urllib.urlopen(foodlink)
		testobj = BeautifulSoup(testest)
		weightID = str(testobj.find('select',{'id' : "food_entry_weight_id"}).find('option')['value'])
		foodid = hrefLink['href'].split('/')[3]
		foodid = foodid.encode('ascii','ignore')
		weightID = weightID.encode('ascii','ignore')
		foodlink = 'http://www.myfitnesspal.com/food/update_nutrition_facts_table/'+foodid+'?id='+foodid+'&quantity=1&weight_id='+weightID
# searching based on foodname and go to the link in my fitness

		Newquery = requests.get(foodlink).text
		bsObj = BeautifulSoup(Newquery)
		output = bsObj.findAll('td')
		Nutrition = list()
		for i in output:
			Nutrition.append(i.string.encode('ascii','ignore'))
		outLine = ''
		for i in range(1,len(Nutrition),2):
			Nutrition[i] = Nutrition[i].replace(' g','')
			Nutrition[i] = Nutrition[i].replace(' mg','')
			Nutrition[i] = Nutrition[i].replace(',','')
			if (Nutrition[i].find('%') !=-1):
				Nutrition[i] = str(float(Nutrition[i].replace('%',''))/100)
		outLine = outLine +str(foodname)+','+ Nutrition[1]+','+ Nutrition[5]+','+ Nutrition[11]+','+ Nutrition[15]+','+ Nutrition[23]+','+str(float(Nutrition[29])+float(Nutrition[33]))
		print(outLine)
		with open('foodoutput.csv','a') as file:
			file.write(outLine+'\n')
		file.close()
	except:
		continue
f.close()

#bsObj = BeautifulSoup(html.read(), "html.parser")
#foodname = bsObj.findAll("div",{"style":'text-align: center'})
#print(foodname)
