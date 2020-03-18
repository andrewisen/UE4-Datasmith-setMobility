port := 9000

dev:
	open http://localhost:$(port)
	php -S localhost:$(port) -t webb_helper/