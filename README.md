# 🐼 Get started
## 📂 Project structure
```project
|--📂app
|--📂resources
|  |--📂vue
|  |--📂admin
```
### Legend:
1. `/app` dir is for backend enviroment
2. `/resources/vue` dir is for public frontend
3. `/resources/admin` dir is for admin frontend (wordpress dashboard)

## 🔋 Installation
1. Install composer dependencies
```sh
composer install
```

2. Install npm dependencies for vue
```sh
cd resources/vue
npm install
```

3. Install npm dependencies for admin
```sh
cd resources/admin
npm install
```

# ⚙️ Setup
## Project
1. Clone **`.env.example`** to **`.env`**
2. Change **`APP_ENV`** by **`dev`**
3. Update permalinks on Wordpress removing the last slash

## Frontend
### Legend
```sh
# - [pandawp.site]  : current project #
# - [pandawp]       : current theme name #
```

### 👻 Vue
1. Clone **`.env.example`** to **`.env`** (development mode)
2. Clone **`.env.example`** to **`.env.staging`** (local building)
3. Update **`.env`** and **`.env.stagging`** with the same information

```sh
# Development
NODE_ENV=development

# Production + Staging
NODE_ENV=production

VUE_APP_MODE='development|production|staging'
VUE_APP_SITE='http://pandawp.site'
VUE_APP_HOST='pandawp.site'
VUE_APP_API='http://pandawp.site/wp-json/custom/v1'
VUE_APP_THEME='pandawp'
```

### 🛠️ Admin
1. Clone **`config.example.json`** to **`config.json`**
2. Update config.json

```json
{
  ...
  "theme": "pandawp",
  "proxy": "pandawp.site",
  ...
}
```

#  Icons

1. Search new icons on [Iconify](https://icon-sets.iconify.design/):
2. Import `iconify` on each page 

```js
import { Icon } from '@iconify/vue2';
```

3.  Set `Icon` as component on Vue instance

```js
components: {
  Icon,
},
```

4. Add a new icon on template (html):
```html
<Icon icon="eva:close-fill" />
```

#  NPM Scripts

## 👻 Vue
* Development
```sh
npm run vue:serve
```

* Staging
```sh
npm run vue:stage
```

* Production
```sh
npm run vue:build
```

## 🛠️ Admin
* Development
```sh
npm run admin:serve
```

* Production
```sh
npm run admin:build
```
