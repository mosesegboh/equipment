# Assessment repo

To get the full instructions the first step is to get this docker setup running. If you want to go to the instructions
directly check the file under `app/instructions`


## Get it running

These instructions assume docker is already running.

```
# Give execution permissions to composer.sh (windows and linux)
chmod 755 composer.sh

# install the php autoloader
./composer.sh install  

# run the environment
docker-compose up

```

After running these commmands, these urls are available:

- http://localhost:7000/ Portal page with the instructions
- http://localhost:7001/ phpMyAdmin

## Remarks

- If anything is unclear, just ask!

#Tips on what I did regarding the test.
#Database
- I tried as much as possible to use more efficient queries as I unnecessary joins and inner queries.
- indexes on the equipment field in the planning table since it's used as a foreign key and will 
  likely be used in JOIN operations. Also, since we were frequently querying for availability within 
  specific timeframes, I also added indexes on the start and end fields.
- I considered the name field which is currently a text type. If the names of the equipment items aren't 
  extremely long, I could potentially use a varchar type for this field instead, which would be 
  more space-efficient. But I decided to leave it that way due to time constraints.
  - If time was not a constraint, I will partition the planning table by range of start dates, so that 
  all records for a particular year or month are stored together. This can speed up queries that 
  retrieve planning records within specific date ranges.

#Architecture
- I implemented repository patterns, which will create abstraction layer between the data access layer
  and the business logic which will increase testability and maintainability.
- I moved the database connection to a  dedicated service file, which is more elegant.
- I implemented prs-12 coding standards.
- If time wasn't a constraint, I will also implement a controller to handle requests from the index file
  I already implemented the Model and View, part of the MVC architectural pattern.
- since the application reads data much more often than it writes data, and it often needs to calculate 
  the available stock by summing up the quantities from the planning table, I also considered storing 
  the currently reserved quantity directly in the equipment table. This approach can speed up reads but
  can make writes more complex and risky, as you need to ensure that the denormalized data stays 
  consistent with the source data.

