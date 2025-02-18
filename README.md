### RUN APP
1. **Build and start containers**:
    ```bash
    docker-compose build
    docker-compose up -d
    ```

2. **Install dependencies**:
    ```bash
    docker-compose exec php composer install
    ```

3. **Access the application**:
    - Open a browser and go to [http://localhost:8080](http://localhost:8080).
