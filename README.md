<h3><b>Tizimga bo'lgan talablar:</b></h3><br/>

    PHP: 8.0

<h3><b>O'rnatish qadamlari:</b></h3><br/>

1. <code>composer update</code>
	
        Kerakli package larni o'rnatadi

2. Config qilish

        - .env file hosil qiling
        - DB yarating va .env file ni update qiling

3. <code>php artisan key:generate</code>
	
	    Applicatation key yaratadi	

4. <code>php artisan migrate:fresh</code>
	
	    DB ga table va view lar yaratadi	
	
5. <code>php artisan passport:install --force</code>

	    Client ID va Client secret larni generate qiladi.	
	
6. <code>php artisan db:seed</code>
		
	    Superadmin user yaratadi:

	    username: superadmin@byorkit.uz
        password: byork!@#$%

7. Shundan so'ng username, password, client id va client secret yordamida Bearer token olish mumkin.

<br><hr><br>

- Test ni yurgizish: <code>php artisan test</code>

- Test qilinmagan routelarni aniqlash: <code>php artisan ntr</code>
<br>Eslatma: <i>Ushbu buyruq to'g'ri natija berishligi uchun, albatta <b>test</b> dan keyin yurgizilishi kerak</i>

- Yuqoridagi 2 ta buyruqni birdaniga ishlatish: <code>php artisan supertest</code>