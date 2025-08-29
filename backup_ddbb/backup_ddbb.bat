@echo off
REM Ruta de instalación de MySQL
set MYSQL_BIN=D:\xampp-7.4\mysql\bin

REM Datos de conexión
set HOST=localhost
set USER=root
set PASSWORD=belgrado
set DATABASE=acaja

REM Ruta del directorio de copias de seguridad
set BACKUP_DIR=D:\xampp-7.4\htdocs\caja_pampa\backup_ddbb\respaldos

REM Asegúrate de que el directorio de copias de seguridad existe
if not exist %BACKUP_DIR% mkdir %BACKUP_DIR%

REM Nombre del archivo de copia de seguridad
set BACKUP_FILE=%BACKUP_DIR%\%DATABASE%_%date:~-4%-%date:~-7,2%-%date:~-10,2%_%time:~-11,2%-%time:~-8,2%-%time:~-5,2%.sql

REM Comando para realizar la copia de seguridad
"%MYSQL_BIN%\mysqldump" --host=%HOST% --user=%USER% --password=%PASSWORD% %DATABASE% > %BACKUP_FILE%

REM Verificar el resultado
if %ERRORLEVEL% equ 0 (
    echo "Copia de seguridad realizada con éxito en %BACKUP_FILE%"
) else (
    echo "Error al realizar la copia de seguridad"
)
