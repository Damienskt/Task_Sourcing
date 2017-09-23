# Task Sourcing

The system is a catalogue of tasks submitted by users. Users can either submit a task or pick a task. Tasks are general chores such washing a car on Kent Vale’s car park on Sunday or delivering a parcel on Tuesday between 17:00 and 19:00. Users who want to pick a task can bid. Some generic common tasks may be available for task requesters to instantiate. The user who submits a task or the system (your choice) chooses the successful bid. Each user has an account. Administrators can create, modify and delete all entries. Please refer to www.taskrabbit.com for examples and data.


# Setup Guide

Modify this line of code in your httpd.conf (under apache2\conf\ folder) 
to change the default loading page when you go to your localhost.
Approx line 279 or so. DirectoryIndex: sets the file that Apache will serve if a directory is requested.

```html
<IfModule dir_module>
    DirectoryIndex homePage.html homePage.php
</IfModule>
```
