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
driver.get('http://www.careercup.com/page')
dropdown = driver.find_element_by_xpath("//select[@id='company']")
companies = [x.text for x in dropdown.find_elements_by_tag_name("option")][1:]
i = 0
for element in companies:
	i += 1
	print str(i) + '\t' + element + '\tEmploy me!!!'
driver.close()