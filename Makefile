.PHONY: lint
lint:
	@./vendor/bin/ecs check

.PHONY: lint-fix
lint-fix:
	@./vendor/bin/ecs check --fix

.PHONY: analyse
analyse:
	@./vendor/bin/phpstan analyse

.PHONY: test
test:
	@./vendor/bin/pest --parallel
