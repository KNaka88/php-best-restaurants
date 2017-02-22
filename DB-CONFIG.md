best_restaurants



** restaurants
| Field           | Type                | Null | Key | Default | Extra          |
|-----------------|---------------------|------|-----|---------|----------------|
| id              | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| restaurant_name | varchar(255)        | YES  |     | NULL    |                |



** cuisine
| Field        | Type                | Null | Key | Default | Extra          |
|--------------|---------------------|------|-----|---------|----------------|
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| cuisine_type | varchar(255)        | YES  |     | NULL    |                |
