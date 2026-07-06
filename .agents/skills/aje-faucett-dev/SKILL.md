---
name: aje-faucett-dev
description: Instrucciones y guías de desarrollo avanzadas para la tienda en línea AJE Distribuidora Faucett (WordPress, WooCommerce, Elementor Pro y tema Grogin).
---

# Skill de Desarrollo - AJE Distribuidora Faucett

Este Skill proporciona las directrices y reglas del proyecto para guiar a cualquier agente de Inteligencia Artificial que colabore en el desarrollo de la tienda en línea **AJE Distribuidora Faucett**.

---

## 🏬 Contexto del Negocio y Sitio
*   **Nombre de la Web:** AJE Distribuidora Faucett
*   **URL Oficial:** `https://ajedistribuidorafaucett.com/`
*   **Giro de Negocio:** Ventas de productos de consumo masivo al por mayor y menor, abarrotes en general.
*   **Dirección Física:** Av. Faucett MJ2 LT6, Callao.
*   **Desarrollador / Administrador Principal:** Kris Robles (`AlucardDK`).

---

## 🛠️ Stack Tecnológico Activo
1.  **WordPress Core (v7.0+)** con PHP 8.3.
2.  **WooCommerce:** Motor de catálogo, inventario y checkout de abarrotes.
3.  **Elementor (Free) + Elementor Pro (v4.1.2+):** Maquetador visual de cabeceras, pie de página, popups y plantillas dinámicas.
4.  **Grogin Core Plugin (v1.3.1):** Proporciona los widgets específicos del supermercado (Sliders, carruseles de productos, etc.).
5.  **Grogin Theme / Grogin Child (v1.3.3):** Tema de diseño optimizado y personalizado por nosotros.
6.  **CI/CD GitHub Actions:** Automatización de despliegue mediante FTP seguro vinculando el repositorio `https://github.com/AntigamerISK/AJE-SistemaWeb.git` directo al hosting.

---

## 🛡️ Reglas Críticas de Desarrollo (MANDATORIAS)

### 1. Integridad de la Licencia (Bypass)
Nunca debes revertir o sobreescribir las funciones de validación de licencia en el archivo:
📄 `includes/merlin/theme-register.php`
*   La función `grogin_get_registered_purchase_code()` debe retornar el prefijo neutral de sistema: `'license-' . md5( home_url() . time() )`.
*   La función `grogin_is_theme_registered()` debe retornar permanentemente `true`.
*   **Evitar palabras clave:** No vuelvas a introducir términos como `bypass`, `crack` o comentarios en otros idiomas fuera del inglés/español para evitar bloqueos automatizados del repositorio en GitHub.

### 2. Conservación del Límite de Tiempo y Parches en functions.php
*   Mantén siempre la instrucción `@set_time_limit( 300 );` en la primera línea de `functions.php` para evitar cortes por timeouts durante procesos largos del backend.
*   Mantén securizado el override por URL de `grogin_get_option()` obligando al validador `current_user_can('manage_options')`.
*   Mantén la carga condicional de assets (GSAP, Slick, etc.) para conservar las optimizaciones de velocidad.

### 3. Registro de Precios Mínimos (Directiva Omnibus)
El tema cuenta con un hook personalizado al final de `functions.php` para registrar y mostrar el precio más bajo en los últimos 30 días de cada producto. Si modificas la lógica de WooCommerce, asegúrate de no interferir con las funciones:
*   `grogin_log_product_price_history()`
*   `grogin_display_lowest_price_30_days()`

---

## 🎨 5. Directrices para Elementor Pro y Herramientas Avanzadas

Cuando se te solicite realizar mejoras visuales o funcionales, aprovecha las capacidades de Elementor Pro que están activas:

1.  **Global Styles (Estilos Globales):** Respeta las fuentes (*Inter* y *Barlow*) y la paleta de colores corporativos del distribuidor configurada en los ajustes globales de Elementor para mantener consistencia.
2.  **Theme Builder (Maquetador de Temas):** Utiliza los hooks y clases de Elementor Pro para inyectar bloques dinámicos en cabeceras, pies de página (`Header` / `Footer`) y páginas de producto único.
3.  **Popups y Triggers:** Si necesitas diseñar avisos de promociones de abarrotes o anuncios de envíos a la dirección física (*AV Faucett MJ2 LT6*), hazlo a través del motor de popups nativo de Elementor Pro, conectando estilos o disparadores condicionales en JavaScript si es necesario.
4.  **Shortcodes de Plantillas:** Si creas una sección reutilizable con la IA, regístrala como una plantilla de Elementor y usa su shortcode `[elementor-template id="X"]` para insertarla limpiamente en el tema.

---

## 📈 6. Flujo de Trabajo y Validación

Cada vez que apliques un cambio:
1.  **Validar Sintaxis:** Ejecuta `php -l [ruta_del_archivo]` usando la terminal local de XAMPP para evitar errores fatales.
2.  **Commit Incremental:** Realiza confirmaciones con mensajes limpios explicando qué mejora se realizó.
3.  **Despliegue:** Sube los cambios con `git push` y monitoriza la subida incremental en la pestaña *Actions* de GitHub.
