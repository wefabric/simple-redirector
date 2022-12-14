# Wefabric Simple Redirector

Simple redirector used to add temporary redirects.


## Installation
Clone the repository

## Usage
This uses a basic .env file to manage the redirects.
The format is as follows:

### Root url's

```
OLDWEBSITE.NL="https://newwebsite.nl{302}"
```

OLDWEBSITE.NL = The url to redirect from  
https://newwebsite.nl = The url to redirect to  
{302} = The type of redirect. Either 301 or 302.  

### Non root url's
If using a not root url, replace the from slashes or dashes with underscores

```
OLDWEBSITE_ABOUT_US.NL="https://newwebsite.nl/about-us{302}"
```

OLDWEBSITE_ABOUT_US.NL = The url to redirect from  
https://newwebsite.nl/about-us = The url to redirect to  
{302} = The type of redirect. Either 301 or 302.  


### Using the redirect
Run the index.php file within the public directory.
Add 'redirector_debug' to the query parameter to test the redirect (https://domain.com/?redirector_debug)

#LICENSE
Wefabric Simple Redirector is open-sourced software licensed under the MIT license.