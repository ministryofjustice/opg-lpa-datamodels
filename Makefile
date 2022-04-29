.PHONY: test-local
test-local:
	@bash ./test_runner.sh

.PHONY: test
test:
	@docker build -f Dockerfile -t opg-lpa-datamodels-test-runner .; \
	docker run -t opg-lpa-datamodels-test-runner
