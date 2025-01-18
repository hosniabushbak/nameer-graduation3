
## Important command

After installing the project, run this command to migrate database and 
add dummy data:

- php artisan project:int

# For images:
- php artisan storage:link

# For sending alot of sms and emails (jobs)
- php artisan queue:listen
- php artisan config:clear