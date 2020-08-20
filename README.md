<p align="center">Youtube Subscriptions API POC</p>

## About Application

This is Simple POC of youtube API to list, insert, delete subscription in a youtube channel

- List channel subscribers
- Insert subscriber in a channel
- Delete subscriber in a channel

## Installation Procedure

Pull Latest code: 

`https://github.com/lpkapil/youtubesubscriptions.git`

- Create Virtual Host & Host Entry in apache configuration and host file and restart apache server

```
<VirtualHost *:80>
        ServerAdmin webmaster@example.com
        ServerName youtubedash.com
        ServerAlias youtubedash.com
        DocumentRoot /var/www/html/youtubesubscriptions/
        <Directory /var/www/html/youtubesubscriptions>
                AllowOverride all
                Require all granted
        </Directory>
</VirtualHost>
```

`127.0.0.1 youtubedash.com`

- Create a folder 'secrets' inside application root and place the client_secrets.json file and change the file name in codebas inside 'setAuthConfig' property.
Make sure file 'client_secret.json' has read access.

- Open application using URL 

`http://youtubedash.com`

## Asked permissions

Allow the permission asked when opening the url, and it will show array of subscribers. 
By default "listSubscribers" function is called when accessing the url. All functions 
details are listed below.

#### Functions #### 

```
Name: listSubscribers:
Parameters: 
   $client: Google_Client Object
   
Name: insertSubscription:
Parameters: 
   $client: Google_Client Object
   $channelIdToSubscribe: Channel ID which we want to subscribe
   
Name: deleteSubscription
Parameters:
   $client: Google_Client
   $id: Channel id which we wants to unsubscribe
```
