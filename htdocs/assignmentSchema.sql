/***
DONE BY: GROUP 15
KHOR SHAO LIANG, DAMIEN SIM, TEO WEN ZONG, REBECCA TAN
***/
CREATE TABLE account(
	userName VARCHAR(64) PRIMARY KEY,
	email VARCHAR(128) UNIQUE,
	pw VARCHAR(255) NOT NULL,
	firstName VARCHAR(128) NOT NULL,
	lastName VARCHAR(32) NOT NULL,
	dob DATE NOT NULL CHECK (dob < (current_date - interval '18' year)),
	gender VARCHAR(6) NOT NULL CHECK (gender = 'Male' OR gender = 'Female'),
	isAdmin boolean NOT NULL
);
    
CREATE TABLE task(
	taskID SERIAL,
	userName VARCHAR(64) REFERENCES account(username) ON DELETE CASCADE,
	title VARCHAR(255) NOT NULL,
	description VARCHAR(512) NOT NULL,
	type VARCHAR(64) NOT NULL,
	price NUMERIC NOT NULL,
	startDate DATE NOT NULL CHECK (startDate >= current_date),
	startTime TIME NOT NULL,
	endDate DATE NOT NULL CHECK (endDate >= startdate),
	endTime TIME NOT NULL,
	PRIMARY KEY (taskID, username)
);

CREATE TABLE bid(
	bidID SERIAL NOT NULL,
	taskID INTEGER NOT NULL,
	bidder VARCHAR(64) NOT NULL CHECK (bidder <> taskOwner) REFERENCES account(userName) ON DELETE CASCADE,
	taskOwner VARCHAR(64) NOT NULL REFERENCES account(userName) ON DELETE CASCADE,
	status varchar(8) NOT NULL CHECK (status = 'Pending' OR status = 'Accepted' OR status = 'Rejected'),
	bidDate DATE NOT NULL CHECK (bidDate <= current_date),
	bidAmt NUMERIC NOT NULL,
	PRIMARY KEY (bidID,taskID,bidder),
	FOREIGN KEY (taskID,taskOwner) REFERENCES task(taskID,userName) ON DELETE CASCADE
);


--Add User Stored Procedure
CREATE FUNCTION add_user(userName VARCHAR(64), email VARCHAR(128), pw VARCHAR(255),  firstName VARCHAR(128), lastName VARCHAR(32), dob DATE, gender VARCHAR(6), isAdmin boolean) 
    RETURNS void AS $$
    BEGIN
      INSERT INTO account VALUES (username,email,pw,firstName,lastName,dob,gender,isAdmin);
    END;
    $$ LANGUAGE plpgsql;
