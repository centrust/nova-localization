<?php

namespace Centrust\NovaLocalization;

use Centrust\NovaLocalization\Models\Localization;
use Illuminate\Translation\Translator;

/**
 * @property string $InTerm
 */
class TranslateTermTask
{

    public function run(string $term)
    {
        $this->InTerm = $term;
        $Term = $this->parseTerm($term);


        try {
            $Group = Localization::where('group', $this->group)->get()
                ->where('term', $Term);
            if (!$Group->count()) {
                $Group = $this->createNewTerm($Term);
                return $Group;
            } else {
                return $Group->first();
            }

        } catch (\Exception $e) {
            return Null;
        }
    }

    private function parseTerm(string $term)
    {
        $Term = app(Translator::class)->parseKey($term);

        if (!$Term[2] || $Term[2] == Null) {
            $this->group = 'default';
            $Term = $Term[1];
        } else {
            $this->group = $Term[1];
            $Term = $Term[2];
        }
        return $Term;
    }

    private function createNewTerm($term)
    {

        $InTranslatinsEn = __($this->InTerm, [], 'en') == $this->InTerm ? Null : __($this->InTerm, [], 'en');;
        $InTranslatinsAr = __($this->InTerm, [], 'ar') == $this->InTerm ? Null : __($this->InTerm, [], 'ar');

        $Group = Localization::create([
            'group' => $this->group ?? 'default',
            'ar' => $InTranslatinsAr ?? $InTranslatinsEn ?? $term,
            'en' => $InTranslatinsEn ?? $term ?? Null,
            'term' => $term
        ]);
        return $Group;


    }
}
