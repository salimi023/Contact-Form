# README #

RESPONSIVE CONTACT FORM WITH BACKEND ADMIN AND DATABASE

The form is capable of

- sending messages to a determinded e-mail account,
- saving messages to database.

The form provides a password protected admin space for managing the received messages.

FUNCTIONS are as follows:

A) Frontend:

- message sending to e-mail account,
- enhanced SPAM protection (honeypot and CAPTCHA),
- saving messages to MySQL (PDO) database

B) Backend:

- password protected admin space,
- review of saved messages,
- filtering messages by name, e-mail, status and date,
- sending response from the admin space,
- archivating and reactivating messages,
- deleting messages,
- bulk management of messages (deletion, archivation and activation).

Used TECHNOLOGIES:

A) Frontend:

- HTML, CSS, JavaScript, JQuery, AJAX, Bootstrap

B) Backend:

- native PHP (OOP, MVC), MySQL (PDO)

INSTALLATION instructions:

- DB file folder: /admin/db/contact.sql
- DB connections data: /system/class.Dbc.php

For the correct operation basepath has to be set in the config.php file (/system/config.php)!

Link to backend admin space: http(s)://www.yourdomain/admin

Preset admin login data are as follows:

- Login: admin
- Password: adminForm

The aforementioned login data can be overwritten in the relating database table (users) directly.

Setting of E-MAIL data:

- Receiving e-mail address: /system/config.php
- Header data for incoming messages: /controllers/class.MessageMethods.php row 58. (function sendMessage; header)
- Header data for outgoing responses: /admin/controllers/class.AdminMethods.php 49. row (function sendResponse; sender)

If you don't need backend administration you can simply delete the admin folder and the indicated variables and functions from the class.MessageData.php (model folder, please see comments) and the class.UserData.php file from the model folder.     