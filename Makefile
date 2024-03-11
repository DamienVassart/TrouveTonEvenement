SHELL := /bin/zsh

init:
	touch .env.local ; \
	composer install ; \
	php bin/console app:secret:generate ; \
	php bin/console app:database:seturl ; \
	php bin/console doctrine:database:create ; \
	php bin/console doctrine:migrations:migrate ; \
	php bin/console doctrine:fixtures:load ;
.PHONY: init

localites:
	mkdir -p "imports" ; \
	if ! [ -f imports/localites.csv ] && curl --head --silent --fail https://www.data.gouv.fr/fr/datasets/r/51606633-fb13-4820-b795-9a2a575a72f1 2> /dev/null ; then \
	  curl -L -o imports/localites.csv https://www.data.gouv.fr/fr/datasets/r/51606633-fb13-4820-b795-9a2a575a72f1 ; \
	else ; \
		echo "url is invalid and/or file already exists" ; \
	fi ;
.PHONY: localites

adresses:
	mkdir -p "imports" ; \
	mkdir -p "imports/adresses" ; \
	for number in {1..989} ; do \
	  if [ $$number -ge 96 ] && [ $$number -le 970 ] ; then \
	      continue ; \
	  fi ; \
  	filename="/adresses-$$number.csv.gz" ; \
  	csv="/adresses-$$number.csv" ; \
  	if [ $$number -le 9 ] ; then \
  	    filename="/adresses-0$$number.csv.gz" ; \
  	    csv="/adresses-0$$number.csv" ; \
  	fi ; \
  	if ! [ -f "imports/adresses/$$csv" ] && curl --head --silent --fail "https://adresse.data.gouv.fr/data/ban/adresses/latest/csv$$filename" 2> /dev/null ; then \
  	    curl -L -o "imports/adresses/$$filename" "https://adresse.data.gouv.fr/data/ban/adresses/latest/csv$$filename" ; \
  	    gzip -dkf "imports/adresses/$$filename" ; \
  	    rm -f "imports/adresses/$$filename" ; \
	else ; \
		echo "$$number: url is not valid and/or file already exists" ; \
  	fi ; \
	done; \
	if ! [ -f imports/adresses/adresses-2A.csv ] && curl --head --silent --fail https://adresse.data.gouv.fr/data/ban/adresses/latest/csv/adresses-2A.csv.gz 2> /dev/null ; then \
	    curl -L -o imports/adresses/adresses-2A.csv.gz https://adresse.data.gouv.fr/data/ban/adresses/latest/csv/adresses-2A.csv.gz ; \
	    gzip -dkf imports/adresses/adresses-2A.csv.gz ; \
	    rm -f imports/adresses/adresses-2A.csv.gz ; \
	else ; \
		echo "2A: url is invalid and/or file already exists" ; \
	fi ; \
	if ! [ -f imports/adresses/adresses-2B.csv ] && curl --head --silent --fail https://adresse.data.gouv.fr/data/ban/adresses/latest/csv/adresses-2B.csv.gz 2> /dev/null ; then \
		curl -L -o imports/adresses/adresses-2B.csv.gz https://adresse.data.gouv.fr/data/ban/adresses/latest/csv/adresses-2B.csv.gz ; \
		gzip -dkf imports/adresses/adresses-2B.csv.gz ; \
		rm -f imports/adresses/adresses-2B.csv.gz ; \
	else ; \
		echo "2B: url is invalid and/or file already exists" ; \
	fi ;
.PHONY: adresses