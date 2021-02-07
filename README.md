# Hướng dẫn sử dụng
* hệ thống sử dụng cơ chế xác thực kết nối Proxy qua IP , nên điều đầu tiên để sử dụng chúng ta chạy API set ip allow.

* Bạn cần nhập danh sách Key vào file key.txt mỗi key 1 dòng.

## API Set IP ALLOW , cấp quyền truy cập
- Get IP tại : https://ipv6-test.com
- Copy IpV4 , Ipv6
- Mỗi Ip ngăn cách bằng dấu phẩy
### Api LocalHost :
```
localhost/api.php?tinhnang=set_ip_allow&ip=1.2.3.4,11.12.13.14,
```
### API SV :
- Thay KEY và IP vào IP
```
https://sv1.smproxy.net/apit/set_ip_allow?key=KEY&ip=IP
```
