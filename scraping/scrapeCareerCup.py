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
import time
import unicodedata

driver = webdriver.Chrome()	
count = 0
for page in xrange(40):				
	driver.get('http://www.careercup.com/page?sort=votes&n=%d' % (page + 1))
	curr_qs = driver.find_elements_by_xpath("//ul[@id='question_preview']/li[@class='question']")
	for q in curr_qs:
		count += 1
		print str(count) + '\tadmin\t',

		#tags_space = q.find_element_by_xpath(".//span[@class='tags']")
		#hover = ActionChains(driver).move_to_element(tags_space)
		#hover.perform()
		#time.sleep(0.01)
		#tags = tags_space.find_elements_by_xpath(".//*")

		#print '\t',
		#if len(tags) > 0: print tags[0].text,
		#else: print 'NULL',

		#print '\t',
		#if len(tags) > 1: print tags[1].text,
		#else: print 'NULL',

		question = q.find_element_by_xpath(".//span[@class='entry']/a/p")
		content = unicodedata.normalize('NFKD', question.text).encode('ascii', 'ignore')
		content = re.sub(r'\n', r' ', content)
		print content + '\t0\t0\t\t\t\t'
driver.close()