# Project 1 - Discord Bot

## Setup

- How to get an API Token:
  - In Discord's Developer Portal under the Bot's page, select *Copy* under the *TOKEN* section.
- Where to put the token to work with the code:
  - Inside the `Discord-Bot` project folder, create an `.env` file and add the line:
  `DISCORD_TOKEN={your-bot-token}`, replacing `{your-bot-token}` with the copied token value.
- Dependencies
  - `python3`, the python3 core
  - `python3-pip`, python3's package manager
  - `discord.py` python library for Discord's APIs
  - `python-dotenv`, python .env file library 

## Usage 

- My modifications to the code:
  1. Deleted old commands and correlating arrays
  2. Added my own commands and arrays:
    - `jokes`, a string array containing joke messages
    - `memes`, a string array containing the paths to image files
- Bot's Commands:
  - `!joke`
  - `!meme`
- Bot's Responses
  - When prompted with the command `!joke` the bot randomly selects a message from an array of jokes.
  - When prompted with the command `!meme' the bot randomly selects an image file from an array of file paths.

## Research 
In order to run a Discord Bot 24/7, you need to have a computer that runs 24/7. This isn't feasible on a personal computer, which is why most people opt for a dedicated server to host the program. There are several options for this:
  1. Raspberry Pi, which will act as an in-house server. This small computer would be a designated system for running the bot on, giving the user the most server autonomy.
  2. Heroku, a free web application hosting service. This platform allots each user 550 free hours of web hosting per month. This means the bot will not be able to operate 24/7 for the entire month. If the user adds a credit card to their account, they will be alloted 1000 hours each month. With that many hours, they can host a single 24/7 web app for the entire month.  
