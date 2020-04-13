# captcha-solver

This project consists of a Firefox browser extension which utilises the Native Messaging API to solve CAPTCHA images. The images are created from the included CAPTCHA generator.  

## Components and related files

| CAPTCHA generator | CAPTCHA solver | Browser extension  |
| ----------------- | -------------- | ------------------ |
| index.php         | captcha.py     | manifest.json      |
| generate.php      |                | background.js      |
|                   |                | popup.html         |
|                   |                | popup.js           |
|                   |                | captcha.json       |

**Note:** this project uses the Apache web server so the PHP files inside ```captcha``` must be placed inside the htdocs folder

## Flowchart

![Flowchart](https://i.imgur.com/X6ozgss.png)
