# gLoad
Here's a short tutorial on how to add new themes to **gLoad**!

## Creating an HTML template
The HTML template will be used to display the page to users connecting to your server. It's a basic HTML page as you usually create when you are doing traditionnal frontend.
In **gLoad**, you can use some new keywords to imports styles and fetched data. Here, the complete list of everything you can get from **gLoad** :

|  Property  |                 Keyword                 |
|:----------:|:---------------------------------------:|
| Stylesheet | ``{{style: relative_path/style.css}}``  |
| JS Script  | ``{{script: relative_path/script.js}}`` |
|   Avatar   |           ``{{steamavatar}}``           |
|   SteamID  |             ``{{steamid}}``             |

In your HTML code, you can use these keywords directly :
```html
<head>
    <meta charset="UTF8"/>
    <title>Default theme</title>
    {{style: assets/css/style.css}}
</head>
```
This code will be replaced by the parser in :
```html
<head>
    <meta charset="UTF8"/>
    <title>Default theme</title>
    <link href="assets/css/style.css" rel="stylesheet"/>
</head>
```
So just focus on developing your new amazing theme for **gLoad**, and use these keywords when you need it, **gLoad** does the rest of the work for you!

## Files structure
**gLoad** themes are structured like that :
```text
themes/
     -- default/*
           -- assets/
                -- css/
                    -- style.css
                -- js/
                    -- default.js
           -- theme.json /* File containing every informations about this theme */
           -- index.html /* HTML code displayed in the main page */
```
When you are creating a new theme, be sure to also include a `theme.json` file, which will be used to add author's metadatas to the page, and to display more informations in the user's admin panel.
The minimal `theme.json` file must contain the theme author name and the theme name. 
These informations have to be compacted in JSON format, like this :
```json
{
  "author": "Gabriel Santamaria",
  "theme_name": "Default"
}
```