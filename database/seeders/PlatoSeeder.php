<?php
namespace Database\Seeders;

use App\Models\Plato;
use App\Models\Sede;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class PlatoSeeder extends Seeder {
    public function run(): void {
        $santaAna    = Sede::where('slug', 'santa-ana')->first();
        $sanSalvador = Sede::where('slug', 'san-salvador')->first();
        $sanMiguel   = Sede::where('slug', 'san-miguel')->first();

        $almuerzo = Categoria::where('nombre', 'Almuerzos')->first();
        $bebida   = Categoria::where('nombre', 'Bebidas')->first();
        $entrada  = Categoria::where('nombre', 'Entradas')->first();
        $cena     = Categoria::where('nombre', 'Cenas')->first();

        // ── OCCIDENTE (Santa Ana) ──────────────────────────────
        $platosOccidente = [
            ['nombre' => 'Pupusa Royale de Occidente',
             'descripcion' => 'Pupusa artesanal rellena de quesillo ahumado y chicharrón premium, acompañada de curtido fermentado lentamente y salsa de tomate rostizado.',
             'precio' => 8.50, 'categoria_id' => $almuerzo->id],
            ['nombre' => 'Yuca Imperial',
             'descripcion' => 'Yuca frita en aceite de ajo, servida con chicharrón crocante, encurtidos de la casa y reducción de tomate especiado.',
             'precio' => 9.00, 'categoria_id' => $almuerzo->id],
            ['nombre' => 'Tamal de Elote Dorado',
             'descripcion' => 'Tamal de elote tierno cocido al vapor, acompañado de crema fresca artesanal y queso de la región occidental.',
             'precio' => 6.50, 'categoria_id' => $entrada->id],
            ['nombre' => 'Costilla Santa Ana',
             'descripcion' => 'Costilla de cerdo marinada durante 24 horas en especias salvadoreñas y cocida lentamente hasta alcanzar una textura suave y jugosa.',
             'precio' => 14.00, 'categoria_id' => $cena->id],
            ['nombre' => 'Mariscada Sonsonate Premium',
             'descripcion' => 'Selección de mariscos frescos del litoral occidental servidos en caldo aromático de coco y especias.',
             'precio' => 18.00, 'categoria_id' => $almuerzo->id],
        ];

        foreach ($platosOccidente as $plato) {
            Plato::create(array_merge($plato, ['sede_id' => $santaAna->id, 'disponible' => true]));
        }

        $bebidasOccidente = [
            ['nombre' => 'Horchata Royale',
             'descripcion' => 'Receta tradicional enriquecida con canela de Ceilán y almendra tostada.',
             'precio' => 3.00, 'categoria_id' => $bebida->id],
            ['nombre' => 'Atol de Elote Gourmet',
             'descripcion' => 'Preparado con maíz tierno seleccionado y notas de vainilla natural.',
             'precio' => 3.50, 'categoria_id' => $bebida->id],
            ['nombre' => 'Café Volcán de Santa Ana',
             'descripcion' => 'Café de altura servido mediante método de extracción artesanal.',
             'precio' => 4.00, 'categoria_id' => $bebida->id],
            ['nombre' => 'Fresco de Marañón Reserva',
             'descripcion' => 'Elaborado con marañón fresco y un ligero toque cítrico.',
             'precio' => 3.00, 'categoria_id' => $bebida->id],
            ['nombre' => 'Chocolate Occidental',
             'descripcion' => 'Chocolate caliente preparado con cacao salvadoreño premium.',
             'precio' => 3.50, 'categoria_id' => $bebida->id],
        ];

        foreach ($bebidasOccidente as $bebida_item) {
            Plato::create(array_merge($bebida_item, ['sede_id' => $santaAna->id, 'disponible' => true]));
        }

        // ── CENTRO (San Salvador) ──────────────────────────────
        $platosCentro = [
            ['nombre' => 'Pupusa Capital Royale',
             'descripcion' => 'Selección de mini pupusas gourmet con rellenos exclusivos y presentación degustación.',
             'precio' => 12.00, 'categoria_id' => $almuerzo->id],
            ['nombre' => 'Filete Costero del Pacífico',
             'descripcion' => 'Pescado fresco acompañado de vegetales asados y salsa de limón y hierbas.',
             'precio' => 16.00, 'categoria_id' => $cena->id],
            ['nombre' => 'Pollo de la Capital',
             'descripcion' => 'Pechuga de pollo marinada en especias salvadoreñas y servida con puré de plátano maduro.',
             'precio' => 13.00, 'categoria_id' => $almuerzo->id],
            ['nombre' => 'Tabla Cuscatleca',
             'descripcion' => 'Degustación de quesos, embutidos artesanales y acompañamientos tradicionales.',
             'precio' => 15.00, 'categoria_id' => $entrada->id],
            ['nombre' => 'Cazuela del Centro',
             'descripcion' => 'Versión gourmet de la tradicional sopa de res con vegetales seleccionados.',
             'precio' => 11.00, 'categoria_id' => $almuerzo->id],
        ];

        foreach ($platosCentro as $plato) {
            Plato::create(array_merge($plato, ['sede_id' => $sanSalvador->id, 'disponible' => true]));
        }

        $bebidasCentro = [
            ['nombre' => 'Café Especial San Salvador',
             'descripcion' => 'Café premium de altura servido en presentación de especialidad.',
             'precio' => 4.50, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Limonada Royale',
             'descripcion' => 'Limones frescos con hierbabuena y toque de miel artesanal.',
             'precio' => 3.00, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Fresco de Tamarindo Reserva',
             'descripcion' => 'Preparado con tamarindo natural y especias suaves.',
             'precio' => 2.50, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Atol Shuco Signature',
             'descripcion' => 'Inspirado en la receta tradicional con una presentación moderna.',
             'precio' => 3.00, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Té Frío Tropical',
             'descripcion' => 'Infusión de frutas nacionales servida fría.',
             'precio' => 3.00, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
        ];

        foreach ($bebidasCentro as $bev) {
            Plato::create(array_merge($bev, ['sede_id' => $sanSalvador->id, 'disponible' => true]));
        }

        // ── ORIENTE (San Miguel) ───────────────────────────────
        $platosOriente = [
            ['nombre' => 'Pupusa Oriental Signature',
             'descripcion' => 'Pupusas artesanales acompañadas de curtido tradicional, mayonesa de la casa y salsa negra artesanal.',
             'precio' => 8.50, 'categoria_id' => $almuerzo->id],
            ['nombre' => 'Carne Asada Migueleña Royale',
             'descripcion' => 'Corte premium de res servido con chimol fresco y guarniciones regionales.',
             'precio' => 17.00, 'categoria_id' => $cena->id],
            ['nombre' => 'Mariscada Bahía de La Unión',
             'descripcion' => 'Selección de camarones, pescado y moluscos frescos del Golfo de Fonseca.',
             'precio' => 19.00, 'categoria_id' => $almuerzo->id],
            ['nombre' => 'Sopa Marinera Imperial',
             'descripcion' => 'Caldo de mariscos elaborado lentamente con especias orientales.',
             'precio' => 14.00, 'categoria_id' => $almuerzo->id],
            ['nombre' => 'Chanfaina Premium',
             'descripcion' => 'Interpretación elegante del tradicional platillo oriental, conservando sus sabores auténticos.',
             'precio' => 12.00, 'categoria_id' => $cena->id],
        ];

        foreach ($platosOriente as $plato) {
            Plato::create(array_merge($plato, ['sede_id' => $sanMiguel->id, 'disponible' => true]));
        }

        $bebidasOriente = [
            ['nombre' => 'Fresco de Ensalada Oriental',
             'descripcion' => 'Bebida tradicional de frutas finamente cortadas y servida fría.',
             'precio' => 2.50, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Tamarindo Imperial',
             'descripcion' => 'Versión premium del clásico refresco oriental.',
             'precio' => 2.50, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Horchata Migueleña',
             'descripcion' => 'Con una mezcla especial de semillas y especias.',
             'precio' => 3.00, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Fresco de Jocote Corona',
             'descripcion' => 'Preparado con jocote fresco de temporada.',
             'precio' => 2.50, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
            ['nombre' => 'Café de Morazán',
             'descripcion' => 'Café artesanal de montaña servido en métodos filtrados.',
             'precio' => 4.00, 'categoria_id' => Categoria::where('nombre','Bebidas')->first()->id],
        ];

        foreach ($bebidasOriente as $bev) {
            Plato::create(array_merge($bev, ['sede_id' => $sanMiguel->id, 'disponible' => true]));
        }

        // ── PLATILLO INSIGNIA (disponible en las 3 sedes) ─────
        $todasLasSedes = Sede::all();
        foreach ($todasLasSedes as $sede) {
            Plato::create([
                'sede_id'     => $sede->id,
                'categoria_id'=> $almuerzo->id,
                'nombre'      => 'Royal Cuscatlán',
                'descripcion' => 'Un homenaje a la riqueza culinaria salvadoreña. Combina ingredientes emblemáticos de Occidente, Centro y Oriente en una experiencia gastronómica elegante.',
                'precio'      => 24.00,
                'disponible'  => true,
                'es_insignia' => true,
            ]);
        }
    }
}