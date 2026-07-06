# Guía de Despliegue Automático con GitHub Actions

Esta guía explica paso a paso cómo configurar **GitHub Actions** para que, cada vez que hagas `git push` en tu repositorio privado de GitHub, los cambios se suban automáticamente a tu servidor de WordPress sin que tengas que hacer nada manualmente.

---

## 🛠️ Requisitos Previos

Antes de empezar, necesitas:
1. Tener acceso a tu repositorio de GitHub: `https://github.com/AntigamerISK/AJE-SistemaWeb`
2. Los datos de acceso **FTP** o **SFTP** de tu hosting (servidor, usuario y contraseña).
3. Conocer la ruta exacta de la carpeta del tema en tu servidor (ejemplo: `public_html/wp-content/themes/grogin/`).

---

## 🚀 Paso 1: Configurar los Secretos en GitHub

Para no exponer tus contraseñas de FTP públicamente en el código, las guardaremos de forma encriptada en GitHub:

1. Entra a tu repositorio en GitHub.
2. Ve a la pestaña **Settings** (Configuración) en la barra superior.
3. En el menú lateral izquierdo, haz clic en **Secrets and variables** y luego en **Actions**.
4. Haz clic en el botón verde **New repository secret**.
5. Agrega los siguientes tres secretos uno por uno:
   *   **Nombre:** `FTP_SERVER`  
       **Valor:** Tu servidor FTP (ejemplo: `ftp.tuservidor.com` o la dirección IP de tu hosting).
   *   **Nombre:** `FTP_USERNAME`  
       **Valor:** Tu nombre de usuario de FTP.
   *   **Nombre:** `FTP_PASSWORD`  
       **Valor:** Tu contraseña de FTP.

---

## 📁 Paso 2: Crear el Archivo de Configuración en el Proyecto

Debes crear una estructura de carpetas específica en la raíz de tu proyecto local para indicarle a GitHub qué debe hacer:

1. Crea una carpeta llamada `.github` en la raíz de tu proyecto.
2. Dentro de `.github`, crea otra carpeta llamada `workflows`.
3. Dentro de `workflows`, crea un archivo llamado `deploy.yml`.

### Contenido del archivo `deploy.yml`
Copia y pega el siguiente código dentro del archivo `deploy.yml`:

```yaml
name: Despliegue Automático del Tema AJE

on:
  push:
    branches:
      - main  # Se activa automáticamente al subir código a la rama main

jobs:
  web-deploy:
    name: Subiendo cambios al Hosting
    runs-on: ubuntu-latest
    steps:
    - name: 🚚 Obtener la última versión del código
      uses: actions/checkout@v3

    - name: 🚀 Subir archivos por FTP/SFTP
      uses: SamKirkland/FTP-Deploy-Action@v4.3.4
      with:
        server: ${{ secrets.FTP_SERVER }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}
        local-dir: ./  # Sube todos los archivos del repositorio
        server-dir: public_html/wp-content/themes/grogin/  # ⚠️ AJUSTAR ESTA RUTA A LA DE TU HOSTING
```

> ⚠️ **IMPORTANTE:** Cambia la línea `server-dir: public_html/wp-content/themes/grogin/` por la ruta exacta donde se encuentra la carpeta de tu tema en tu hosting.

---

## 📈 Paso 3: Subir los Cambios y Probar

Una vez creado el archivo:
1. Haz un commit de la nueva carpeta:
   ```bash
   git add .github/
   git commit -m "Add GitHub Actions deploy workflow"
   ```
2. Sube los cambios a GitHub:
   ```bash
   git push origin main
   ```
3. Ve a tu repositorio en GitHub y entra en la pestaña **Actions**. Verás que se ha iniciado un proceso en verde. Cuando termine, todos tus archivos del tema estarán subidos en tu servidor web en tiempo real.

---

## 💡 Consejos para Desarrolladores

*   **Rendimiento:** Esta acción solo sube los archivos que han cambiado, por lo que tus despliegues serán ultra veloces.
*   **Seguridad:** Dado que el repositorio de GitHub es privado, tus archivos modificados y lógicas personalizadas de licencia están a salvo del público general.
