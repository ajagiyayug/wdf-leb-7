#  PHP Form Processing & Secure Storage

> **Practical Topic:** Server-Side Form Handling, Input Validation, Sanitization, and CSV/JSON Data Persistence.

---

##  Project Overview

This repository contains a full backend implementation for processing registration and contact forms securely using **PHP**. 

The main objective of this practical is to demonstrate how to handle user data safely on the server side before persisting it. Instead of directly saving raw input, the system validates and sanitizes all incoming data, prevents security threats like **XSS** and **SQL Injection**, and writes the clean records into **CSV or JSON** flat files.

---

##  Key Features & Concepts Covered

###  1. Secure HTTP POST Handling
- Form data is submitted using the `POST` method instead of `GET` to keep user payloads hidden from URL parameters.

###  2. Server-Side Validation & Sanitization
- Checks for required fields, valid email formats, and string lengths.
- Sanitizes inputs to neutralize dangerous characters and scripts.

###  3. Safe File Operations
- Data is formatted into **JSON** or **CSV** structure.
- Writes records safely into isolated storage folders with strict permission checks.

###  4. Dynamic User Feedback
- Renders real-time, user-friendly success and error alert messages based on validation outcomes.

---

## Tech Stack & Requirements

- **Backend Language:** PHP (7.x / 8.x)
- **Local Server Environment:** XAMPP / WAMP / LAMP
- **Frontend / Dev Tools:** HTML5, CSS3, Browser Developer Tools
- **Data Persistence:** CSV / JSON flat files

---

##  Learning Outcome

By exploring this project, you will understand:
- How backend form submission pipelines work in web development.
- Best security practices for validating and sanitizing user inputs.
- How to implement lightweight, file-based data logging without needing a heavy database setup.
