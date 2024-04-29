## Blog CMS
This is CMS Blog Build with Laravel, It has full control panel functionality with 3 roles [admin, writer, user]

**dashboard home page**
![Alt text](https://github.com/mahroustamim/blog/blob/main/blog-dashbaord.png)


**website home page**
![Alt text](https://github.com/mahroustamim/blog/blob/main/blog-website.png)


## Features Overview
****Admin Dashboard****
- Multilingual Interface: Supports multiple languages for accessibility.
- Overview Metrics: Displays the number of visits, posts, and users. Includes two charts showing the most visited categories.
-  **Content Management**:
- Posts: Add, edit, and delete posts.
- Categories: Add, edit, and delete categories.
- Users: Add new users with specific permissions and roles, edit, and delete existing users.
- **Site Customization**:
- Branding: Set the blog's logo and favicon.
- Blog Settings: Configure the blog title and description. Link to Facebook and Instagram accounts.
- **Account Management**:
- Admin Account: Edit details or log out.
- Data Management: Pagination and search functionality for all administrative tables.


**Writer Dashboard**
- Multilingual Interface: Supports multiple languages.
- Overview Metrics: View counts of visits, posts, and users, and charts for the most visited categories.
- **Content Creation**:
- Posts: Ability to add new posts.
- Category Viewing: Access and view categories.
- **Account Management**:
- Writer Account: Edit details or log out.
- Data Management: Pagination and search functionality for tables related to content creation.


**Blog Features**
- **Dynamic Content Display**:
- Home Page: Showcases the latest 5 posts, top 5 most visited posts, and a comprehensive list of categories, each displaying two posts.
- **Interactivity**:
- Search Functionality: Enables searching within posts.
- Comments System: Allows users to comment on posts.
- User Account Settings:
- Profile Management: Users can edit their profile details or log out.
- **Pages**:
- Standard Pages: Home, Category, Post, About Us, and Settings.
  
## installation 

```
$ git clone https://github.com/mahroustamim/blog.git
$ cd blog
$ composer install
$ cp .env.example .env # THEN EDIT YOUR ENV FILE ACCORDING TO YOUR OWN SETTINGS.
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
```



## database schema

![Alt text](https://github.com/mahroustamim/blog/blob/main/blog.drawio.png)

## License

gym management systeme is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
