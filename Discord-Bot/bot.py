import os

import discord
import random
from dotenv import load_dotenv

load_dotenv()
#print(os.getenv('DISCORD_TOKEN'))
TOKEN = os.getenv('DISCORD_TOKEN')
GUILD = os.getenv('DISCORD_GUILD')

client = discord.Client()

@client.event
async def on_ready():
    print(f'{client.user} has connected to Discord!')

    for guild in client.guilds:
        if guild.name == GUILD:
            break

    print(
        f'{client.user} is connected to the following guild:\n'
        f'{guild.name}(id: {guild.id})'
    )

@client.event
async def on_message(message):
    if message.author == client.user:
        return

# jokes string array, containing the jokes
    jokes = [
        (
            "A group of engineering students and their teacher were given free airplane tickets to go on a vacation"
            "Once on the plane, the captain announced that they were on the plane the students had built. "
            "Everyone freaked out and rushed out of the plane, except for the teacher who stayed there calmly. "
	    "When the flight attendant asked why she hadn't left, she responded: "
	    		"'I know the abilities of my students. This plane won't even start."
        ),
	(
            "My only wish upon dying is to have my remains scattered at Disneyland, that is unless they insist ."
	    "on my remains being cremated. In that case just a regular burial."
	),

	(
	    "If baseball really wanted to get exciting, they'd let a celebrity throw the LAST pitch. "
	    "Bases loaded, here's Danny DeVito."
	),
            "Just got back from the mutation lab and boy are my arms legs.",

        (
	    "Me: It doesn't have a tail, so I'm pretty sure it's a hamster.\n"
	    "Tech Support: Okay, fine. Right-click the hamster."
	),
	    "Guess who's got 7 thumbs and a set of keys to a cadaver lab?",
	    "Gravitational waves create the heaviest surfing.",
	(
	    "Game: Choose your language\n"
	    "Me: English\n"
	    "Game: Are you sure? Language cannot be switched mid-game\n"
            "Me [literally only speaks English but is terrified of commitment]: ...gimme a minute"
	),
	    "In the words of Mark Twain's wife, Shania Twain, 'that don't impress me much'"
    ]

# memes string array, containing the path to the images
    memes = [
        "images/doomg.jpg",
	"images/DebHee.jpg",
	"images/busLegs.png",
	"images/pakidge.jpg",
	"images/DiscordTeacher.jpg"
    ]

# if statemnt comparing message content to possible command
    if message.content == "!joke":
        response = random.choice(jokes)
       	await message.channel.send(response)
    elif message.content == "!meme":
        response = random.choice(memes)
        await message.channel.send(file=discord.File(response))


client.run(TOKEN)
