# Written for Mac OSX.
# N.B. The browser might need a refresh before the PHP server is loaded.

port := 9000

dev:
	open http://localhost:$(port)
	php -S localhost:$(port) -t web_helper/