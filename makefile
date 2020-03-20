port := 9000

dev:
	open http://localhost:$(port)
	php -S localhost:$(port) -t web_helper/