#!/usr/bin/env python
# Scrape the CareerCup website and get interview questions.
#   Author: Yuxuan "Ethan" Chen
#     Date: November 5, 2014
#  Version: 0.9.1
#
# ===================================================
#                   VERSION HISTORY
# ===================================================
# Version 0.9.1   				  Posted Nov  5, 2014
# ___________________________________________________
# Version 0.9                     Posted Nov  2, 2014
#  - Can navigate to the questions page for a company 
#  - Can get a list of the companies
# ===================================================

import re
from selenium import webdriver
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
import random
import sys
import time
import unicodedata

def deunicode(s):
	return re.sub(r'\n', r' ', unicodedata.normalize('NFKD', s).encode('ascii', 'ignore'))

if len(sys.argv) != 3: sys.exit('usage: ./script questions.txt answers.txt')
qfile = sys.argv[1]
afile = sys.argv[2]
qf = open(qfile, 'w')
af = open(afile, 'w')
driver = webdriver.Chrome()	
bdriver = webdriver.Chrome()

companies = [ "A9" , "aaa" , "abc" , "Abs india pvt. ltd." , "Accenture" , "Achieve Internet" , "Adap.tv" , "Adobe" , "ADP" , "Advent" , "Advisory Board Company" , "Agilent Technologies" , "Akamai" , "Alcatel Lucent" , "Alliance Global Servies" , "Altera" , "Amazon" , "AMD" , "Amdocs" , "American Airlines" , "Apache Design" , "Apple" , "AppNexus" , "Argus" , "Aricent" , "Arista Networks" , "Aristocrat Gaming" , "Ask.com" , "Aspire Systems" , "ASU" , "Athena Health" , "Atmel" , "Automated Traders Desk" , "Autonomy Zantaz" , "Axiom Sources" , "Baidu" , "Bank of America" , "Barclays Capital" , "Bazaarvoice" , "Big Fish" , "Bloomberg LP" , "Blue Jeans" , "Bocada" , "Boeing" , "Booking.com" , "Boomerang Commerce" , "Brainware" , "Broadsoft" , "BrowserStack" , "BT" , "Cadence Inc" , "Capgemini" , "CapitalIQ" , "CareerCup" , "Caritor" , "Cavium Networks" , "CCN" , "CDAC-ACTS" , "CGI-AMS" , "Chegg.com" , "Chelsio Communications" , "Chicago Mercantile Exchange" , "Chronus" , "Cisco Systems" , "Citigroup" , "Citrix Online" , "Citrix System Inc" , "Cloudera" , "Cloudmere, Inc." , "CMC LTD" , "Cognzant Technology Solutions" , "Collective" , "Computer Associates" , "Continental" , "Credit Suisse" , "CrimsonLogic" , "Crompton Greeves" , "CSC" , "CSR" , "Cubic Transportation Systems Limited" , "D2L" , "Daptiv" , "Defense Research and Development Organization of India" , "Deloitte Consulting LLP" , "Delve Networks" , "Denmin Group" , "Deshaw Inc" , "deutsche bank" , "Did-it.com" , "Directi" , "Dover Organization" , "Druva Software pvt ltd" , "Ebay" , "EFI" , "Egenera" , "Electronic Arts" , "EMC" , "Epic Systems" , "Epsilon" , "Ericsson" , "Eterno Infotech Pvt Ltd" , "Expedia" , "EZ Prints" , "F5 Networks" , "Fabrix" , "Facebook" , "FactSet Research Systems, Inc" , "Fair Issac" , "Fiorano" , "FlexTrade" , "Flipkart" , "Fortinet" , "Future Advisor" , "Future Group, Mumbai" , "Fynanz" , "Gartner" , "Gayatri Vidya Parishad" , "GE (General Electric)" , "Georgia Pacific" , "Global Scholar" , "Globaltech Research" , "Gluster" , "GoDaddy" , "Gold-Tier" , "Goldman Sachs" , "Google" , "Green Bricks" , "Groupon" , "GrubHub" , "Guruji" , "Hackerrank" , "Harman Kadron" , "HCL" , "HCL America" , "Headrun Technologies Pvt Ltd" , "Hewlett Packard" , "Hi5" , "Highbridge Capital" , "Hired.com" , "Home Depot" , "Honeywell" , "Huawei" , "Hunan Asset" , "Ibibo" , "IBM" , "Iconologic" , "Igate" , "IIT-D" , "iLabs" , "Imagination Technologies" , "IMG" , "Infibeam" , "Infinium" , "Informatica" , "Infosys" , "Initto" , "InMobi" , "Intel" , "Intelligrape" , "Interactive Brokers" , "Interactive Design" , "Internet Question" , "InterraIT" , "Intuit" , "ION idea" , "ION Trading" , "iPowerFour" , "Iron Mountain" , "Ittiam Systems" , "Ivycomptech" , "Izon" , "Jabong" , "Jane Street" , "JDA" , "job tessio" , "Josh" , "JP Morgan" , "Juniper Networks" , "Kalido" , "Kaseya" , "Kerkestavni Computecha Corporatci" , "Kingfisher" , "Kingfisher Airlines" , "Kiwox" , "KLA Tencor" , "Knewton" , "Knoa Software" , "Knowledge Systems" , "KnowledgeBase" , "Kohl's" , "Komli Media" , "Kpro Solutions" , "Lab126" , "Labs247" , "Laserfiche" , "LexisNexis" , "Lime Labs" , "Linkedin" , "LiteratureBay.com" , "Live Nation" , "LiveRamp" , "Lockheed Martin" , "London Investment Bank" , "LSI" , "Lunatic Server Solutions" , "MAGMA" , "makemytrip" , "Manhattan associates" , "MAQ" , "MarketRX" , "Marketshare Inc." , "Marvell" , "Mathworks" , "McAfee" , "Medio Systems" , "Megasoft" , "Mentor Graphics" , "Micron" , "Microsoft" , "MicroStrategy" , "MIH" , "Mindtree Wireless India" , "Model N" , "Monitor Group" , "Monotype" , "Morgan Stanley" , "Motorola" , "MounzIT" , "Moyer Group" , "mSpot" , "Myntra" , "Myntra.com" , "N/A" , "National Informatics Centre" , "National Instruments" , "Ness" , "NetApp" , "Netflix" , "Nexabion" , "Nextag" , "Nisum Technologies" , "Nivio Technologies" , "Nomura" , "Nook" , "Notfamous" , "Novell" , "NVIDIA" , "omega" , "One97" , "OnMobile" , "Oracle" , "Overstock.com" , "Palantir Technology" , "PayPal" , "Pega" , "Persistent Systems" , "Philips" , "Pinterest" , "PJ Pvt Ltd" , "Pocketgems" , "PRDS" , "Progress" , "Pubamatic" , "Pubmatic" , "QNX" , "QSI HealthCare" , "Qual Ex" , "Qualcomm" , "Rapleaf" , "Raytheon" , "Real Networks" , "Rebellion Research" , "RelQ Software Company Limited" , "Research In Motion" , "Ricoh " , "RightC" , "Riverbed" , "Roamware" , "RoviCorp" , "Roxar" , "RSA" , "Sabre Holdings" , "Safenet" , "Sage Software" , "Salesforce" , "Samsung" , "Sap Labs" , "Sapient Corporation" , "SAS Research" , "Schneider Electric" , "Search Media" , "Sears Holding" , "Shutterfly" , "Siemens" , "SIG (Susquehanna International Group)" , "SignPost" , "Sileria Inc." , "Singapore Technologies" , "Socialcam" , "Softchoice" , "Software AG" , "Sonoa Systems" , "Sophos" , "Spotify" , "SRMicro Info Systems" , "Starbucks" , "Starent Networks" , "StartUp" , "student" , "SumoLogic" , "SunGard " , "SWAPTON SOLUTIONS" , "Symantec" , "Symphony Services" , "SynCfusion" , "Synopsys R&D" , "Take Two Interactive" , "Tally Solutions" , "TATA Consultancy Services" , "Tech India Line" , "Techlogix" , "Tejas Networks" , "Tellabs" , "Texas Instruments" , "The Digital Group" , "The Royal Bank of Scotland Chennai" , "thePlatform" , "Thirdware Technologies" , "Thomson Reuters" , "ThoughtWorks" , "Toppr" , "TP" , "TRG" , "Tribal Fusion" , "Tricon" , "Trilogy" , "Turing Software" , "Twitter" , "Two Sigma" , "United HealthGroup" , "unknown" , "Urban Touch" , "US" , "USAA" , "USInternetworking" , "UST global" , "VANS" , "Vanu" , "Vdopia" , "Video Gaming Technologies" , "Vistaprint" , "Vizury" , "VMWare Inc" , "Walmart Labs" , "Watchguard" , "Wichorus" , "Wipro Technologies" , "Wireless Generation" , "WorksApp" , "Xurmo" , "Yahoo" , "Yatra.com" , "Yelp" , "Zillow" , "Zoosk" , "ZS Associates" , "Zycus" , "Zynga" ]
topics = [ 'Algorithm' , 'Android' , 'Application / UI Design' , 'Arrays' , 'Assembly' , 'Automata' , 'Behavioral' , 'Bit Manipulation' , 'Brain Teasers' , 'C' , 'C' , 'C++' , 'Cache' , 'Coding' , 'Compiler' , 'Computer Architecture & Low Level' , 'computer network' , 'Data Mining' , 'Data Structures' , 'Database' , 'Debugging' , 'Distributed Computing' , 'Dynamic Programming' , 'Experience' , 'Front End Web Development' , 'General Questions and Comments' , 'Graphics' , 'Hash Table' , 'Ideas' , 'Java' , 'JavaScript' , 'Knowledge Based' , 'Large Scale Computing' , 'Linked Lists' , 'Linux Kernel' , 'Math & Computation' , 'Matlab' , 'Matrix' , 'Network' , 'Networking / Web / Internet' , 'Object Oriented Design' , 'Online Test' , 'Operating System' , 'Operators' , 'Perl' , 'PHP' , 'Probability' , 'Problem Solving' , 'Puzzle' , 'Python' , 'Questions YOU should ask!' , 'Replacing multiple string occurences from a text' , 'Sales' , 'Security' , 'Sets' , 'Sorting' , 'SQL' , 'Stacks' , 'String Manipulation' , 'System Administration' , 'System Design' , 'technical' , 'Terminology & Trivia' , 'test' , 'Testing' , 'Threads' , 'Trees and Graphs' , 'Unix' , 'unix system programmin' , 'unix system programming' , 'XML' ]
users = [ 'admin', 'azmjc', 'bexbp', 'bjsiw', 'cfzie', 'dgjji', 'dkebi', 'ethan', 'eucmc', 'ewigy', 'fmzze', 'fowai', 'ftfck', 'gilit', 'huiqq', 'jippy', 'krxlv', 'mrjku', 'nhibd', 'nwkeg', 'plapd', 'qywrh', 'rdfeo', 'rrmeu', 'sgiwy', 'sqzqo', 'tenuw', 'ufdxg', 'vanul', 'wbqzu', 'xhgls', 'zeice']
count = 0
acount = 0
for page in xrange(40):				
	driver.get('http://www.careercup.com/page?sort=votes&n=%d' % (page + 1))
	curr_qs = driver.find_elements_by_xpath("//ul[@id='question_preview']/li[@class='question']")
	for q in curr_qs:
		count += 1

		tags_space = q.find_element_by_xpath(".//span[@class='tags']")
		hover = ActionChains(driver).move_to_element(tags_space)
		hover.perform()
		time.sleep(0.01)
		tags = tags_space.find_elements_by_xpath(".//*")

		company = None
		topic = None

		for tag in tags:
			if company != None and topic != None: break 
			t = deunicode(tag.text)
			if company == None:
				if t in companies:
					company = companies.index(t) + 1
			if topic == None:
				if t in topics:
					topic = topics.index(t) + 1

		question = q.find_element_by_xpath(".//span[@class='entry']/a/p")
		content = deunicode(question.text)
		
		qf.write(str(count) + '\tadmin\t' + content + '\t' + str(company) + '\t' + time.strftime('%Y-%m-%d %H:%M:%S') + '\t\t\t' + str(topic) + '\t\t\n' )

	
	for q in curr_qs:
		q_page = q.find_element_by_xpath(".//span[@class='entry']/a").get_attribute('href')
		bdriver.get(q_page)
		answers = bdriver.find_elements_by_xpath("//div[@class='uncollapsedComment']//div[@class='commentBody']/p")
		for ans in answers:
			acount += 1
			af.write(str(acount) + '\t' + users[random.randint(0, len(users) - 1)] + '\t' + str(page * 30 + curr_qs.index(q) + 1) + '\t' + deunicode(ans.text) + '\t' + time.strftime('%Y-%m-%d %H:%M:%S') + '\t\t\n') 

driver.close()
qf.close()
af.close()