#!/usr/bin/env python
# Scrape the CareerCup website and get interview questions.
#   Author: Yuxuan "Ethan" Chen
#     Date: November 2, 2014
#  Version: 0.9

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select

driver = webdriver.Chrome()					
driver.get('http://www.careercup.com/page')
select = Select(driver.find_element_by_id('company'))
select.select_by_visible_text('Facebook')
go_button = driver.find_element_by_xpath("//input[@value='Go']").click()