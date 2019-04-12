# gLoad
**gLoad** is a *Garry's Mod* loading-screen designed with frontend developers in mind. The goal is to let developers create their own loading-screen in a super-easy way.

## What is it
Designed for frontend developers, **gLoad** is a *Garry's Mod* loading screen including a complete admin panel.
If you are a server owner, you'll appreciate it for its robustness. If you are a frontend developer, stop waiting and start creating a theme for **gLoad** ! 
## Developers
Your are a developer and you wanted to know how **gLoad** theming is working ? See : [THEME_STRUCTURE.md](https://github.com/Gabyfle/gLoad/blob/master/themes/THEME_STRUCTURE.md) for more informations.

#### How does it works
Every theme is located in its own folder in  the `theme` folder. When the page is loaded, the PHP script get the theme's name in the `config.ini` file and load the theme located in  `themes/<theme-name>/`.

**gLoad** allows you to use built-in Javascripts functions to get data from *Garry's Mod*.

## Credits

#### _Admin panel_ and _Default theme_ :
[Bootstrap CSS framework](https://getbootstrap.com) for a quicker frontend development


## License
This code is distributed free of charge under the [Apache 2.0 license](https://www.apache.org/licenses/LICENSE-2.0). The code is distributed "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND.  For more information, please visit [LICENSE](https://github.com/Gabyfle/gLoad/blob/master/LICENSE)