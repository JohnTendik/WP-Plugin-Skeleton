# WP-Plugin-Skeleton
Bare bones starter plugin for WordPress. This is the most bare-bones plugin starter. There are no opinions, or rules here. You start with your plugin class and you're off to the races. However you want to structure this plugin project is up to you.


### How to get started?

When you first clone this project you will notice that there are a bunch of `@plugin-name@` `@plugin-slug@` type areas. You need to fill out the package.json file and then run `npm run generate` which will rename all of the areas in this project to your plugin's name.

1) Set the following options in your package.json

```
"name": "jt-limit-purchase",
"prettyName": "JT Limit Purchase",
"slug": "jt_limit_purchase",
"const": "JT_LIMIT_PURCHASE",
"className": "JT_Limit_Purchase",
```

By the way, you never want to limit a purchase so ignore my plugin name above as an example.

**name** This is your regular npm package name for the project. Cannot include spaces, numbers, capitals or weird characters.
**prettyName** This is your plugin name but pretty. This is the name that will display in the plugins menu option in WordPress.
**slug** This is your plugin name slug. Lowercase and underscored.
**const** This is your plugin name constant. This is ALL CAPS AND UNDERSCORED.
**className** This is your plugin class name. Classes are usually camel cased and underscored.

2) run `npm run generate`
3) Start building your plugin
