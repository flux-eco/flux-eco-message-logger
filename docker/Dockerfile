FROM fluxms/flux-eco-biotope:v2022-01-08-2 AS flux-eco-message-logger-orbital

# |-------------------------------------------------------------------------- \
# | author martin@fluxlabs.ch
# |-------------------------------------------------------------------------- \

# |-------------------------------------------------------------------------- \
# | General Environment Variables
# |-------------------------------------------------------------------------- \
ENV FLUX_ECO_HTTP_SYNAPSE_AUTOLOAD_FILE_PATH=/opt/flux-eco-message-logger-orbital/app/autoload.php
ENV FLUX_ECO_HTTP_SYNAPSE_HTTP_API_FQCN=FluxEco\\MessageLoggerOrbital\\Adapters\\Api\\HttpApi
ENV FLUX_ECO_LOGGER_ORBITAL_LOG_FILES_DIRECTORY_PATH=/var/log/flux-eco-message-logger-orbital

USER root
RUN mkdir -p "/var/log/flux-eco-message-logger-orbital"
RUN chown  -R www-data:www-data /var/log/flux-eco-message-logger-orbital
COPY --chown=www-data:www-data ./app /opt/flux-eco-message-logger-orbital/app
USER www-data
WORKDIR /opt/flux-eco-message-logger-orbital/app

ENTRYPOINT ["sh", "./docker_entrypoint.sh"]