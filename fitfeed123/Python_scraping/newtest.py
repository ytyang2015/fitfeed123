import json 
import requests 
import urllib 
import sys 
from bs4 import BeautifulSoup
import csv
def findamount(s):
	s=s.lstrip()
	try:
		start = 0
		end = s.index(' ')
		result = s[start:end]
		if ('/' in result):
			result=result.split('/')
			return float(result[0])/ float(result[1])
		return float(result)
	except ValueError:
		return 0
#f = open ('food.txt','r')
#line = f.readlines()
#for foodname in line:
f = open ('food.txt','r')
line = f.readlines()
k=0
for foodname in line:
	flavor = {'chicken':0, 'beef':0, 'pork':0,'fish':0,'cheese':0, 'oil':0, 'salty':0,'hot':0,'sweet':0,'sour':0}
	with open('testout.txt','a') as file:
		foodname = foodname.replace('\n','')
		foodname = foodname.replace(' ','+')
		url = 'http://www.recipe.com/search/?searchType=recipe&searchTerm='+foodname
		testest = urllib.urlopen(url)
		testobj = BeautifulSoup(testest, "html.parser")
		topselection = str(testobj.find('div',{'class' : "topSection"}).a['href'])
		test2 = urllib.urlopen(topselection)
		testobj = BeautifulSoup(test2, "html.parser")
		try: 
			integrents = testobj.find('div',{'class':'recipe__ingredientContainer'}).findAll('span')
			file.write(foodname+'\n')
			staff = []
			temp = ''
			for i in integrents:
				value = str(i.string) 
				if unicode(value[0],'utf-8').isnumeric():
					staff.append(temp)
					temp = ''
					temp = temp + ' '+value
					print(temp)

				else:
					temp = temp + ' '+value
			for i in staff:
				print(i)
				if ('chicken' in i):
					flavor['chicken']=findamount(i)
				if ('beef' in i):
					flavor['beef']=findamount(i)
				if ('pork' in i):
					flavor['pork']=findamount(i)
				if ('fish' in i):
					flavor['fish']=findamount(i)
				if ('cheese' in i):
					flavor['cheese']=findamount(i)
				if ('oil' in i):
					flavor['oil']=findamount(i)
				if ('salt' in i):
					flavor['salty']= flavor['salty'] + findamount(i)
				if (('pepper' in i) | ('spice' in i) | ('onion' in i) | ('mustard' in i)):
					if ('onion' in i):
						flavor['hot']=flavor['hot']+findamount(i)/4
					else:
						if ('mustard' in i):
							flavor['hot']=flavor['hot']+findamount(i)/4
						else:
							flavor['hot']=flavor['hot']+findamount(i)

				if (('sugar' in i) | ('pear' in i) | ('orange' in i) | ('honey' in i) | ('sweet' in i)):
					if ('orange' in i):
						flavor['sweet']=flavor['sweet']+findamount(i)/4
					else:
						if ('honey' in i):
							flavor['sweet']=flavor['sweet']+findamount(i)*3/4
						else:
							flavor['sweet']=flavor['sweet']+findamount(i)

				if (('lemon' in i) | ('tomato' in i) | ('orange' in i) | ('sour' in i)):
					if ('orange' in i):
						flavor['sour']=flavor['sour']+findamount(i)/5
					else:
						flavor['sour']=flavor['sour']+findamount(i)

			file.write(json.dumps(flavor)+'\n')
			print(k)
			k+=1
		except:			
			integrents = testobj.find('div',{'class':'ingredients'}).findAll('span',{'class':'ingredient'})
			for i in integrents:
				amount = str(i.find('span',{'class':'ingredientmeasure count'}).getText())
				staff = str(i.find('span',{'class':'name'}).getText())
				value = 0
				value = findamount(amount+' ')

				if ('chicken' in staff):
					flavor['chicken']=value
				if ('beef' in staff):
					flavor['beef']=value
				if ('pork' in staff):
					flavor['pork']=value
				if ('fish' in staff):
					flavor['fish']=value
				if ('cheese' in staff):
					flavor['cheese']=value
				if ('oil' in staff):
					flavor['oil']=value
				if ('salt' in staff):
					flavor['salty']= flavor['salty'] + value
				if (('pepper' in staff) | ('spice' in staff) | ('onion' in staff) | ('mustard' in staff)):
					if ('onion' in staff):
						flavor['hot']=flavor['hot']+value/4
					else:
						if ('mustard' in staff):
							flavor['hot']=flavor['hot']+value/4
						else:
							flavor['hot']=flavor['hot']+value

				if (('sugar' in staff) | ('pear' in staff) | ('orange' in staff) | ('honey' in staff) | ('sweet' in staff)):
					if ('orange' in staff):
						flavor['sweet']=flavor['sweet']+value/4
					else:
						if ('honey' in staff):
							flavor['sweet']=flavor['sweet']+value*3/4
						else:
							flavor['sweet']=flavor['sweet']+value

				if (('lemon' in staff) | ('tomatoes' in staff)|('tomato' in staff) | ('orange' in staff) | ('sour' in staff)):
					if ('orange' in staff):
						flavor['sour']=flavor['sour']+value/5
					else:
						flavor['sour']=flavor['sour']+value
			file.write(json.dumps(flavor)+'\n')
			print(k)
			k+=1


file.close()

