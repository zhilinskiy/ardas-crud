## About

Basic e-commerce app admin panel example.
The store has products (name, price) with options (name, value).
Product can have many options. Admin can create options and attach them to product.
Pages:
- product index
    - table columns: name, price, creating date
    - links to:
        - new product
        - update product
        - delete product with confirmation pop-up
    - search by product name
- product create with errors validation
- product edit with errors validation

## Setup and run
- clone this repo
- copy `.env.example` to `.env` at `/` and `scr/` folders
- run `docker-compose up -d`
- connect to container `docker exec --user=www -it ardas bash`
- run from container `composer install`
- run from container `php artisan migrate --seed`
- open `http://localhost:8081`
