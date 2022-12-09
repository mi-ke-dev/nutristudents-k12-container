<?php
declare(strict_types=1);
namespace Bytelaunch\Nutristudents\Models;

use Bytelaunch\Nutristudents\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodOrderStudentCount extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'site_id',
        'meal_type_id',
        'age_range_id',
        'recipe_id',
        'option_id',
        'student_count',
        'last_used_at'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function mealType(): BelongsTo
    {
        return $this->belongsTo(MealType::class);
    }

    public function ageRange(): BelongsTo
    {
        return $this->belongsTo(AgeGradeOffering::class);
    }

    public function menuDayOption(): BelongsTo
    {
        return $this->belongsTo(MenuCycleDayOptionComponent::class,'option_id');
    }
  
}
