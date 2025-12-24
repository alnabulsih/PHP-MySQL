//Task 1.1:
CREATE DATABASE library_db;

CREATE TABLE Authors (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    author_id INT,
    FOREIGN KEY (author_id) REFERENCES authors(author_id)
);



//task 1.2
CREATE DATABASE shop_db;
USE shop_db;

CREATE TABLE Customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    FOREIGN KEY (customer_id)
        REFERENCES Customers(customer_id)
        ON DELETE CASCADE
);

CREATE TABLE Products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL
);

CREATE TABLE Order_Products (
    order_id INT,
    product_id INT,
    quantity INT DEFAULT 1,

    PRIMARY KEY (order_id, product_id),

    FOREIGN KEY (order_id)
        REFERENCES Orders(order_id)
        ON DELETE CASCADE,

    FOREIGN KEY (product_id)
        REFERENCES Products(product_id)
        ON DELETE CASCADE
);


//task 1.3
Primary Key
Uniquely identifies each row in a table
Cannot be NULL
Only ONE primary key per table
Automatically creates a unique index
Often used as the main reference for foreign keys

Unique Constraint
Ensures no duplicate values in a column (or group of columns)
Can allow NULL values (MySQL allows multiple NULLs)
You can have MULTIPLE unique constraints in one table
Used when data must be unique but is not the main identifier

////////////////////////////////////////////////////////////////
2.1CREATE DATABASE shop_db;
USE shop_db;

CREATE TABLE Customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    FOREIGN KEY (customer_id)
        REFERENCES Customers(customer_id)
        ON DELETE CASCADE
);

CREATE TABLE Products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL
);

CREATE TABLE Order_Products (
    order_id INT,
    product_id INT,
    quantity INT DEFAULT 1,

    PRIMARY KEY (order_id, product_id),

    FOREIGN KEY (order_id)
        REFERENCES Orders(order_id)
        ON DELETE CASCADE,

    FOREIGN KEY (product_id)
        REFERENCES Products(product_id)
        ON DELETE CASCADE
);

2.2
A partial dependency occurs when a non-key attribute depends on only part of a composite primary key, not the whole key.

A transitive dependency occurs when a non-key attribute depends on another non-key attribute, instead of depending directly on the primary key.
///////////////////////////////////////////////////////////////
3.1
insert into stu (name,born_dad,email)
values
('ahmad',2001,'ahmad@gmail.com'),
('mohammad',2000,'mohammad@gmail.com'),
('ali',1999,'ali@gmail.com');

select * from stu
where born_dad>=2000
order by name;

update stu 
set email='new@gmail.com'
where id = 1;

delete from stu
where id = 1;
///////////////////////////////////////////////////////////////
4.1
select c.customer_id, c.name,o.order_id
from customers c 
left join orders o on c.customer_id = o.customer_id
where o.order_id is null;

List users who spent more than the average. (i dont understand this task)


SELECT email
FROM Subscribers
UNION
SELECT email
FROM Users;



///////////////////////////////////////////////////////////////
//5.1
data : Raw facts or figures that have not been processed
Information : Processed or organized data that is meaningful and useful.
Database :A structured collection of related data stored in a way that makes it easy to access, manage, and update.
DBMS : A software system used to store, retrieve, and manage data in a database.
RDBMS : A type of DBMS that stores data in tables with relationships.

//5.2
1. A hospital uses a database to store patient records, including personal information, medical history, and test results. Doctors and nurses can quickly retrieve patient data to provide accurate treatment. The database also tracks appointments, billing, and medication inventory, ensuring everything is organized and up to date. Using the database, the hospital can generate reports for management, such as the number of patients treated or medicines used. This system reduces errors and improves efficiency in day-to-day operations.

2. A school uses a database to store student records, including names, grades, and attendance. Teachers can record and access students’ marks for each subject quickly. The database also manages class schedules, exam results, and fee payments, making administrative tasks more efficient. Reports like top-performing students or class averages can be generated automatically. This helps the school stay organized and reduce errors.
3.A bank uses a database to store customer accounts, transaction histories, and personal information. Customers’ deposits, withdrawals, and transfers are recorded in real time. The database also tracks loans, credit cards, and account balances, enabling accurate financial management. Reports on daily transactions or suspicious activities can be generated automatically. This ensures the bank operates securely and efficiently.