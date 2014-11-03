from urllib2 import Request, urlopen, URLError

glassdoorrequest=Request('http://api.glassdoor.com/api/api.htm?v=1&format=json&t.p=25746&t.k=f3EAbbGKRZw&action=interviews&q=pharmaceuticals&userip=192.168.43.42&useragent=Mozilla/%2F4.0')

try:
    response=urlopen(glassdoorrequest)
    glassdoor=response.read()
    print(glassdoor)
except URLError,e:
    print("API Request error.")
    
