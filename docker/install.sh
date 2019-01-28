if [[ ! -d ./.env ]]; then
    cp ./example.env .env
fi
folders="logs/nginx logs/php logs/mysql logs/memcached data/sessions data/mysql data/memcached data/elasticsearch data/jenkins_home data/redis ../tests"
for var in $folders
do
    if [[ ! -d "./$var" ]]; then
        mkdir -p $var
    fi
done