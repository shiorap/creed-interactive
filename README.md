# Creed Interactive Coding Challenge

# Requirements
- Docker
- Postman (optional)

# Installation

Boot the containers:
```
./vendor/bin/sail up -d 
```

Database migration:
```
./vendor/bin/sail artisan migrate
```

Import podcast data:
```
./vendor/bin/sail artisan db:seed --class=PodcastSeeder
```

# Testing

## Test Data
Based on the data provided, there are 2 genres (127 and 140). Due to constraints and no data available, some genre_id were not imported.

## Steps
- Load `/storage/postman/postman_collection.json` into Postman
- Execute Register to generate a new user and api bearer token
- Optional: Once you have a user, you can try logging in to generate api bearer token
- Copy the token to execute Podcast By Genre
