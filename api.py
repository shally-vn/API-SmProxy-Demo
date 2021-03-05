import requests,json,sys
def get_file(file):
    with open(file, 'r') as theFile:
        content = theFile.read()
        return content
URL_API = 'https://sv1.smproxy.net/apit/'
class Api():
    def __init__(self):
            self.list_key = get_file('key.txt').splitlines()
            self.list_ip = get_file('ip_set.txt').splitlines()
    def set_ip_allow(self,ip):
        data = {}
        data['data'] = [{'key':key,'ip':ip} for key in self.list_key]
        return self.post('set_ip_allow',data)
    def set_listip_allow(self):
        data,p = {},[]
        if len(self.list_key) == len(self.list_ip):
            i = 0
            for key in self.list_key:
                p.append({'key':key,'ip':self.list_ip[i]})
                i+=1
            data['data'] = p
            s = self.post('set_ip_allow',data)
        else:
            s = '{"message":"list ip and list key not equal"}'
        return s
    def info_proxy(self):
        data = {}
        data['key'] = self.list_key
        return self.post('info_proxy',data)
    def renew_ip(self):
        data = {}
        data['key'] = self.list_key
        return self.post('renew_ip',data)
    def post(self,path,data):
        r = requests.post('{url}{path}'.format(url=URL_API,path=path),data=json.dumps(data))
        s = r.text if r.status_code == 200 else '{"message":"error request"}'
        return s
tinhnang = sys.argv[1]
if tinhnang == 'set_ip':
    d = Api().set_ip_allow(sys.argv[2])
elif tinhnang == 'set_listip':
    d = Api().set_listip_allow()
elif tinhnang == 'info_proxy':
    d = Api().info_proxy()
elif tinhnang == 'renew_ip':
    d = Api().renew_ip()
else:
    d = 'not found'
print(d)