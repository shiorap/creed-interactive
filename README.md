# Creed Interactive Coding Challenge

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
