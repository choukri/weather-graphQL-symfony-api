# weather-graphQL-symfony-api
This is a Weather API Microservice using GraphQL using Symfony4,Yahoo Weather API and docker.
It accepts a city name and return one day weather prediction.

# Usage:

Input: city name.
the schema of the query :
{
  weather(city: "name of city") {
    date_text
    condition {
      text
      temperature
    }
    atmosphere {
      pressure
      visibility
      humidity
    }
    astronomy{
      sunrise
      sunset
    }
    wind {
      chill
      direction
      speed
    }
  }
}


Output: One day weather prediction.

# Requirements:
- Install Docker
- Create the app yahoo using the https://developer.yahoo.com

# Installation:

$ clone a repo using 
 git clone https://github.com/choukri/weather-graphQL-symfony-api.git
$ cd weather-graphQL-symfony-api/
$ docker-compose build
$ docker-compose up -d
$ cd myweatherproject
$ composer install
$ cd ..
$ docker-compose up -d

the Api is exposed on http://localhost:8000.
This api work:
- by using a method POST request with a parameter named query that contains the GraphQL query 
- or by using method POST or GET with a graphql query.

# Example
request : 
{
  weather(city: "casablanca") {
    date_text
    condition {
      text
      temperature
    }
    atmosphere {
      pressure
      visibility
      humidity
    }
    astronomy{
      sunrise
      sunset
    }
    wind {
      chill
      direction
      speed
    }
  }
}
result :
{
    "data": {
        "weather": {
            "date_text": "2019-07-07",
            "condition": {
                "text": "Partly Cloudy",
                "temperature": 70
            },
            "atmosphere": {
                "pressure": 29.85,
                "visibility": 10,
                "humidity": 76
            },
            "astronomy": {
                "sunrise": "6:27 am",
                "sunset": "8:44 pm"
            },
            "wind": {
                "chill": 70,
                "direction": 23,
                "speed": 8.08
            }
        }
    }
}





