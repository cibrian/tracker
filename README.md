# **Tracker Project** 

The Tracker Project is a simple web-based visitor tracking system that allows users to track unique visits on different pages of their websites.

## **Features**

- **JavaScript Tracker** – Clients embed a script on their websites.
- **Database Storage** – Stores unique visit data.
- **User Interface** – Displays visit statistics via a dashboard.
- **Authentication** – Login required to access the dashboard.
- **Domain Separation** – Each admin manages a specific domain's visit data.
- **Unique Visit Tracking** – Only records unique visits per page per user.

---

## **Pages**

### **Admin Panel / Dashboard**
- **Login Page:** [localhost:8080](http://localhost:8080)
- **Dashboard:** [localhost:8080/dashboard.php](http://localhost:8080/dashboard.php) _(Requires authentication)_

**Default Users:**
| Username        | Manages Site | Password |
|----------------|-------------|----------|
| `admin_8081`  | 8081 visits | `secret` |
| `admin_8082`  | 8082 visits | `secret` |

### **Dummy Sites**
#### **Dummy Site 1 (8081)**
- **Blog Page:** [localhost:8081/blog.php](http://localhost:8081/blog.php)
- **About Page:** [localhost:8081/about.php](http://localhost:8081/about.php)

#### **Dummy Site 2 (8082)**
- **Blog Page:** [localhost:8082/blog.php](http://localhost:8082/blog.php)
- **About Page:** [localhost:8082/about.php](http://localhost:8082/about.php)

---

## **Tracker Implementation**

### **Tracker Script**
The JavaScript tracker is located in:  
`scripts/tracker.js`

To include it in a site, add the following snippet:

```html
<script src="http://localhost:8080/scripts/tracker.js"></script>
```

### **How It Works**
- `tracker.js` automatically collects visit data and sends it to:  
   **[http://localhost:8080/sendVisitorData.php](http://localhost:8080/sendVisitorData.php)**

#### **Example Usage**
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Page</title>
</head>
<body>
    <h1>Welcome to the About Page</h1>
</body>
<!-- Include Tracker -->
<script src="http://localhost:8080/scripts/tracker.js"></script>
</html>
```

### **Database Setup for Tracking**
Before tracking can begin, you must register the website domain in the database:

```sql
INSERT INTO domains (domain) VALUES ('mysite.com');
```

---

## **Project Structure**
```plaintext
tracker/
│── scripts/
│   └── tracker.js  # JavaScript tracker script
│── src/
│   ├── Actions/        # Business logic handling
│   ├── DataObjects/    # Encapsulates database-related objects
│   ├── Handlers/       # Helper classes for PHP interactions
│   ├── Repositories/   # Handles database queries (PDO)
│   └── ValueObjects/   # Encapsulates single property logic
│── vendor/
│── Migrations.sql      # Database schema and dummy data
│── .gitignore
│── about.php           # Dummy site for testing
│── authenticate.php    # Handles user authentication
│── blog.php            # Dummy site for testing
│── composer.json       # PHP dependencies
│── composer.lock
│── dashboard.php       # Displays visit statistics
│── docker-compose.yml  # Docker container setup
│── Dockerfile          # PHP environment setup
│── getVisits.php       # API to fetch visit data
│── index.php           # Login page
│── logout.php          # Session logout
│── navbar.php          # UI navigation bar
│── README.md
│── sendVisitorData.php # API to store visit data
```

---

## **API Endpoints**

### **Track User’s Visit**
#### **Endpoint:** `POST /sendVisitorData`
**Description:** Registers a unique user visit.

 **Request Example**
```json
{
  "url": "mysite.com/about"
}
```

 **Success Response**
```json
{
    "result": "Visit created"
}
```

 **Error Response (Duplicate Visit)**
```json
{
    "error": "Visit already registered"
}
```

---

### **Get Total Visits per Page by Date**
#### **Endpoint:** `GET /getVisits?date=YYYY-MM-DD`
**Description:** Retrieves all visits from a given date.

 **Response Example**
```json
[
    {
        "total": 2,
        "url": "/about.php"
    },
    {
        "total": 1,
        "url": "/blog.php"
    }
]
```

---

## **Setup Instructions**

### **Build and Start Containers**
```sh
docker-compose build
docker-compose up -d
```

### **Install Dependencies**
```sh
docker-compose exec php composer install
```

### **Run Migrations**
- Open the database.
- Execute SQL queries from **Migrations.sql**.

### **Access the Application**
- Open a browser and navigate to:  
  [http://localhost:8080](http://localhost:8080)

---

##  Database Connection Details
| Parameter  | Value |
|------------|-------|
| **Username** | `root` |
| **Password** | `example` |
| **Database** | `testdb` |
| **Host** | `localhost` |
| **Port** | `3306` |

---

## **Notes**
- The tracker only stores **unique** visits per page per user.
- Ensure that the `tracker.js` file is properly embedded in every page you want to track.
- Admin credentials are predefined in the database, you can update them as needed.