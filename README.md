## General
AlwaysTime is a Pocketmine plug-in that works to always lock the time on your server

## Features
- Lock time on your server
- Can manage time as desired
- Can set the world you want to time-lock
- Can change modes ranging from “whitelist”, “blacklist” and “allworlds”
  
## Configuration
```yaml
# Configuration for AlwaysTime plugin

# Change the mode you want, set “whitelist” or “blacklist” or "allworlds"
# If the mode is “whitelist”, then only the world in the config is affected by the alwaystime function.
# If the mode is “blacklist”, then only the world in the config is not affected by the alwaystime function.
# If the mode is “allworlds”, then all worlds will be affected by the alwaystime function.
mode: whitelist

# Set up the world you want to organize
worlds:
  - lobby
  - world

# Set a time for your world, time will be locked with your set time
# Set the time according to the time you add
set-time: day

# Add the time you want
add-time:
  day: 1000
  sunrise: 23000
  noon: 6000
  sunset: 12000
  night: 13000
  midnight: 18000
```
