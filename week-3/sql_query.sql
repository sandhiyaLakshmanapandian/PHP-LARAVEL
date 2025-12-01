CREATE TABLE Trainer (
    id NUMBER PRIMARY KEY,
    name VARCHAR2(20) NOT NULL,
    phno NUMBER,
    mailid VARCHAR2(50),
    Weektest_mark NUMBER,
    mentor VARCHAR2(20) NOT NULL
);

Insert into trainer (id,name,phno,mailid,Weektest_mark,mentor) values(1,'sam',1234567890,'sam@gmail.com',86,'gupthan');
Insert into trainer (id,name,phno,mailid,Weektest_mark,mentor) values(2,'sai',6789012345,'sai@gmail.com',96,'gupthan');
Insert into trainer (id,name,phno,mailid,Weektest_mark,mentor) values(3,'sarin',0987654321,'sarin@gmail.com',69,'pangaj');
Insert into trainer (id,name,phno,mailid,Weektest_mark,mentor) values(4,'sanju',5432167890,'sanju@gmail.com',87,'pangaj');


select * from Trainer ;

UPDATE Trainer set Weektest_mark=92 where name='sarin';

select * from Trainer;

DELETE from Trainer where id=4;

select * from Trainer;

--Getting the highest mark trainer---

SELECT Id,name from trainer as First_Rank ORDER BY Weektest_mark DESC limit 1;

---Getting 2nd rank holder--

SELECT id, name FROM trainer ORDER BY Weektest_mark DESC LIMIT 1 OFFSET 1;




    
