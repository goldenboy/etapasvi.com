<?php slot('body_id') ?>body_encyclopedia<?php end_slot() ?>
<?php $counter = 0; ?>
<h1 id="up"><?php echo __('Encyclopedia') ?></h1>
<table class="contents"><tr>
<td>
	<ol class="in_text contents">
		<li><a href="#gautama_buddha"><?php echo __('Gautama Buddha (Siddhartha, Sakyamuni, Tathagata)') ?></a></li>
		<li><a href="#ten_characteristics_of_buddha"><?php echo __('Ten Characteristics of Buddha') ?></a></li>
		<li><a href="#middle_way"><?php echo __('Middle Way') ?></a></li>
		<li><a href="#four_noble_truths"><?php echo __('Four Noble Truths') ?></a></li>
		<li><a href="#noble_eightfold_path"><?php echo __('Noble Eightfold Path') ?></a></li>
		<li><a href="#three_marks_of_existence"><?php echo __('Three marks of existence') ?></a></li>
        <li><a href="#ten_negative_actions"><?php echo __('Ten negative actions') ?></a></li>
		<li><a href="#samsara"><?php echo __('Samsara') ?></a></li>		
		<li><a href="#nirvana"><?php echo __('Nirvana') ?></a></li>
		<li><a href="#parinirvana"><?php echo __('Parinirvana') ?></a></li>
		<li><a href="#moksha"><?php echo __('Moksha') ?></a></li>
		<li><a href="#klesha"><?php echo __('Klesha') ?></a></li>
		<li><a href="#mara"><?php echo __('Mara') ?></a></li>
		<li><a href="#dharma"><?php echo __('Dharma') ?></a></li>
		<li><a href="#sangha"><?php echo __('Sangha') ?></a></li>
		<li><a href="#refuge"><?php echo __('Refuge') ?></a></li>
<?php /*		<li><a href="#schools_and_traditions_of_buddhism"><?php echo __('Schools and traditions of Buddhism') ?></a></li> */ ?>
<?php /*		<li><a href="#mahayana"><?php echo __('Mahayana ("Great Vehicle")') ?></a></li> */ ?>
<?php /*		<li><a href="#tibetan_buddhism"><?php echo __('Tibetan Buddhism') ?></a></li> 
		<li><a href="#vajrayana"><?php echo __('Vajrayana') ?></a></li>
		<li><a href="#the_sakya_tradition"><?php echo __('The Sakya Tradition in Tibetan Buddhism') ?></a></li> */ ?>
        <li><a href="#tummo"><?php echo __('Tummo') ?></a></li>
	</ol>
</td>
<td>
	<ol class="in_text" start="18">				
		<li><a href="#bodhisattva"><?php echo __('Bodhisattva') ?></a></li>
		<li><a href="#six_paramitas"><?php echo __('Six paramitas (perfections)') ?></a></li>
		<li><a href="#dhyana"><?php echo __('Dhyana') ?></a></li>
		<li><a href="#arhat"><?php echo __('Arhat') ?></a></li>
		<li><a href="#anuttara_samyak_sambodhi"><?php echo __('Samyak Sambodhi (Anuttara-samyak-sambodhi)') ?></a></li>
		<li><a href="#maitreya"><?php echo __('Maitreya') ?></a></li>
		<li><a href="#asanga"><?php echo __('Asanga') ?></a></li>
		<li><a href="#the_future_coming_of_maitreya"><?php echo __('The future coming of Maitreya') ?></a></li>
<?php /*		<li><a href="#buddha_nature"><?php echo __('Buddha-nature') ?></a></li> */ ?>
		<li><a href="#atman"><?php echo __('Atman (Buddhism)') ?></a></li>
		<li><a href="#atman_hinduism"><?php echo __('Atman (Hinduism)') ?></a></li>
		<li><a href="#anatman"><?php echo __('Anatta (Anatman, "not-self")') ?></a></li>
		<li><a href="#paramatman"><?php echo __('Paramatman (Supersoul)') ?></a></li>
<?php /*		<li><a href="#god_in_buddhism"><?php echo __('God in Buddhism') ?></a></li> */ ?>
		<li><a href="#bhagavan"><?php echo __('Bhagavan') ?></a></li>
		<li><a href="#gyani"><?php echo __('Gyani') ?></a></li>
		<li><a href="#kali_yuga"><?php echo __('Kali Yuga') ?></a></li>
		<li><a href="#tamang"><?php echo __('Tamang') ?></a></li>
		<li><a href="#kunchusum"><?php echo __('Kunchusum') ?></a></li>		
	</ol>
</td>
</tr></table>
<h2 id="gautama_buddha"><?php echo ++$counter; ?>. <?php echo __('Gautama Buddha (Siddhartha, Sakyamuni, Tathagata)') ?></h2>
<?php echo __('Siddhartha Gautama, also known as Sakyamuni or Shakyamuni  ("sage of the Sakyas"), or Tathagata ("one who has thus gone" and "one who has thus come") was a spiritual teacher who founded Buddhism.') ?> 

<div class="video_object">
<?php if ($sf_user->getCulture() == 'ru'): ?>
<OBJECT width="470" height="353"></PARAM></PARAM></PARAM><EMBED src="http://video.rutube.ru/70c3e4cd8b1dc7f6c3042d437b2394ee" type="application/x-shockwave-flash" wmode="window" width="470" height="353" allowFullScreen="true" ></EMBED></OBJECT>
<? else: ?>
<embed id=VideoPlayback src=http://video.google.com/googleplayer.swf?docid=-6493885183630667611&hl=ru&fs=true style=width:400px;height:326px allowFullScreen=true allowScriptAccess=always type=application/x-shockwave-flash> </embed>
<?php endif ?>
</div>
<?php echo __('Gautama was born in 563 BCE in Lumbini (modern day Nepal). His mother was Queen Maya Devi. On the night Gautama was conceived, she dreamt that a white elephant with six white tusks entered her right side, and ten months later Gautama was born. Various sources hold that the Buddha\'s mother died at his birth, a few days or seven days later. The infant was given the name Siddhartha, meaning "he who achieves his aim". During the birth celebrations, the hermit seer Asita announced that the child would either become a great king or a great holy man.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>98)); ?>
<?php echo __('Siddhartha, said to have been destined to a luxurious life as a prince, had three palaces (for seasonal occupation) especially built for him. His father, King Suddhodana, wishing for Siddhartha to be a great king, shielded his son from religious teachings or knowledge of human suffering.') ?> 
<br/><br/>
<?php echo __('At the age of 29, Siddhartha left his palace in order to meet his subjects. Siddhartha was said to have seen an old man. Disturbed by this, when told that all people would eventually grow old by his charioteer Channa, the prince went on further trips where he encountered, variously, a diseased man, a decaying corpse, and an ascetic. Deeply depressed by these sights, he sought to overcome old age, illness, and death by living the life of an ascetic.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>97)); ?>
<?php echo __('After asceticism and concentrating on meditation Siddhartha is said to have discovered what Buddhists call the Middle Way. Sitting under a pipal tree, now known as the Bodhi tree, he vowed never to arise until he had found the Truth. At the age of 35, he attained enlightenment in the fifth lunar month. Gautama, from then on, was known as the Buddha or "Awakened One." Buddha is also sometimes translated as "The Enlightened One."') ?> 
<br/><br/>
<?php echo __('At this point, he is believed to have realized complete awakening and insight into the nature and cause of human suffering which was ignorance, along with steps necessary to eliminate it. This was then categorized into "Four Noble Truths"; the state of supreme liberation — possible for any being — was called Nirvana. He then allegedly came to possess the Ten Characteristics, which are said to belong to every Buddha.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="ten_characteristics_of_buddha"><?php echo ++$counter; ?>. <?php echo __('Ten Characteristics of Buddha') ?></h2>
<ol>
<li><?php echo __('thus gone (tathāgata)') ?></li>
<li><?php echo __('a worthy one (arhat)') ?></li>
<li><?php echo __('perfectly self-enlightened (samyak-sambuddha)') ?></li>
<li><?php echo __('perfected in knowledge and conduct (vidyā-carana-sampanna )') ?></li>
<li><?php echo __('well gone (sugata)') ?></li>
<li><?php echo __('unsurpassed (anuttara)') ?></li>
<li><?php echo __('knower of the world (loka-vid)') ?></li>
<li><?php echo __('leader of persons to be tamed (purusa-damya-sārathi)') ?></li>
<li><?php echo __('teacher of the gods and humans (śāsta deva-manusyānam)') ?></li>
<li><?php echo __('the Blessed One or fortunate one (bhagavat)') ?></li>
</ol>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="middle_way"><?php echo ++$counter; ?>. <?php echo __('Middle Way') ?></h2>
<?php echo __('Buddhism teaches a Middle Way, i.e. avoiding the extreme views of eternalism and nihilism.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>126)); ?>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="four_noble_truths"><?php echo ++$counter; ?>. <?php echo __('Four Noble Truths') ?></h2>
<?php echo __('Four Noble Truths formulated by Sakyamuni Buddha') ?>:
<br/><br/>
<ol class="in_text">
<li><i><?php echo __('The Nature of Suffering.') ?></i><br/>
<?php echo __('Birth is suffering, aging is suffering, illness is suffering, death is suffering; sorrow, lamentation, pain, grief and despair are suffering; union with what is displeasing is suffering; separation from what is pleasing is suffering; not to get what one wants is suffering. In brief, the five aggregates subject to clinging are suffering.') ?></li>
<li><i><?php echo __('Suffering\'s Origin.') ?></i><br/>
<?php echo __('Cause of suffering is craving, which leads to a cycle of birth and death (samsara). The source of suffering is attachment and hatred. All the rest detrimental emotions are usually generated by them. Their effects lead to suffering. The source of attachment and hatred is ignorance, ignorance of the true nature of all beings and inanimate objects. This is not simply a consequence of a lack of knowledge, but a false world view, wrong understanding of reality.') ?></li>
<li><i><?php echo __('Suffering\'s Cessation.') ?></i><br/>
<?php echo __('State, in which there is no suffering, is achievable. Elimination of attachment, hatred, envy, and intolerance is the way to a state beyond suffering.') ?></li>
<li><i><?php echo __('The Way (marga) Leading to the Cessation of Suffering.') ?></i><br/>
<?php echo __('It is the Noble Eightfold Path.') ?></li>
</ol>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="noble_eightfold_path"><?php echo ++$counter; ?>. <?php echo __('Noble Eightfold Path') ?></h2>
<?php echo __('The Noble Eightfold Path is one of the principal teachings of the Buddha, who described it as the way leading to the cessation of suffering (dukkha) and the achievement of self-awakening. It is used to develop insight into the true nature of phenomena (or reality) and to eradicate greed, hatred, and delusion. The Noble Eightfold Path is the fourth of the Buddha\'s Four Noble Truths; the first element of the Noble Eightfold Path is, in turn, an understanding of the Four Noble Truths. It is also known as the Middle Path or Middle Way.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>129)); ?>
<?php echo __('All eight elements of the Path begin with the word "right", which translates the word samyañc (in Sanskrit) or sammā (in Pāli). These denote completion, togetherness, and coherence, and can also suggest the senses of "perfect" or "ideal":') ?> 
<br/><br/>
<ol>
<li><?php echo __('Right view') ?></li>
<li><?php echo __('Right intention') ?></li>
<li><?php echo __('Right speech') ?></li>
<li><?php echo __('Right action') ?></li>
<li><?php echo __('Right livelihood') ?></li>
<li><?php echo __('Right effort') ?></li>
<li><?php echo __('Right mindfulness') ?></li>
<li><?php echo __('Right concentration') ?>.</li>
</ol>
<br/>
<?php echo __('In Buddhist symbolism, the Noble Eightfold Path is often represented by means of the dharma wheel, whose eight spokes represent the eight elements of the path.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="three_marks_of_existence"><?php echo ++$counter; ?>. <?php echo __('Three marks of existence') ?></h2>
<?php include_component('photo', 'show', array('id'=>121, 'in_list'=>true)); ?>

<?php echo __('According to the Buddha there are "three characteristics" of existence') ?>:
<br/><br/>
<ul class="in_text">
	<li><?php echo __('Anicca (Sanskrit anitya) "inconstancy" or "impermanence". This refers to the fact that all conditioned things are in a constant state of flux. In reality there is no thing that ultimately ceases to exist; only the appearance of a thing ceases as it changes from one form to another. Imagine a leaf that falls to the ground and decomposes. While the appearance and relative existence of the leaf ceases, the components that formed the leaf become particulate material that may go on to form new plants.') ?></li>
	<li><?php echo __('Dukkha (Sanskrit duhkha) or "unsatisfactoriness". Nothing found in the physical world or even the psychological realm can bring lasting deep satisfaction.') ?></li>
	<li><?php echo __('Anatta (Sanskrit anatman) or "non-Self".') ?></li>
</ul>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="ten_negative_actions"><?php echo ++$counter; ?>. <?php echo __('Ten negative actions') ?></h2>
<ul class="in_text">
	<li><?php echo __('3 of the body: killing, stealing, sexual misconduct') ?></li>
	<li><?php echo __('4 of the speech: lie, words that divide, bad words and twaddle') ?></li>
	<li><?php echo __('3 of the mind: desire (to have something what belongs to an other), malevolence and mistaken visions') ?></li>
</ul>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="samsara"><?php echo ++$counter; ?>. <?php echo __('Samsara') ?></h2>
<?php include_component('photo', 'show', array('id'=>99)); ?>
<?php echo __('Samsara is the cycle of birth, death and rebirth (i.e. reincarnation). The concept of samsara is closely associated with the belief that one continues to be born and reborn in various realms in the form of a human, god, animal, or other being, depending on karma ("action" or "doing"; whatever one does, says, or thinks). Thus Samsara is the cycle of cause and effect.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="nirvana"><?php echo ++$counter; ?>. <?php echo __('Nirvana') ?></h2>
<?php include_component('photo', 'show', array('id'=>113)); ?>
<?php echo __('The Buddha described nirvana (nibbāna) as the perfect peace of the state of mind that is free from craving, anger and other afflictive states.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>100)); ?>
<?php echo __('The Buddha explains nirvana as "the unconditioned" mind, a mind that has come to a point of perfect lucidity and clarity due to the cessation of the production of volitional formations. This is described by the Buddha as "deathlessness" and as the highest spiritual attainment, the natural result that accrues to one who lives a life of virtuous conduct and practice in accordance with the Noble Eightfold Path. Such a life engenders increasing control over the generation of karma. It produces wholesome karma with positive results and finally allows the cessation of the origination of karma altogether with the attainment of nirvana. Otherwise, beings forever wander through the impermanent and suffering-generating realms of desire, form, and formlessness, collectively termed samsara.') ?> 
<br/><br/>

<?php echo __('A person can attain nirvana without dying.') ?> 
<br/><br/>

<h2 id="parinirvana"><?php echo ++$counter; ?>. <?php echo __('Parinirvana') ?></h2>
<?php echo __('When a person who has realized nirvana dies, his death is referred as parinirvāna, his fully passing away, as his life was his last link to the cycle of death and rebirth (samsara), and he will not be reborn again. What happens to a person after his parinirvāna cannot be explained, as it is outside of all conceivable experience.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="moksha"><?php echo ++$counter; ?>. <?php echo __('Moksha') ?></h2>
<?php echo __('In Indian religions, Moksha or Mukti, literally "release" (both from a root muc "to let loose, let go"), is the liberation from samsara, the cycle of death and rebirth or reincarnation and all of the suffering and limitation of worldly existence after the realization that the Atman is in fact Paramatman in Advaita philosophy.') ?> 
<br/><br/>
<?php echo __('Moksha\'s meaning is similar to that of Nirvana in Buddhism.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="klesha"><?php echo ++$counter; ?>. <?php echo __('Klesha') ?></h2>
<?php echo __('The Buddhist term klesha (kilesa) is typically translated as "defilement" or "poison". In early Buddhist texts the kleshas generally referred to mental states which temporarily cloud the mind and manifest in unskillful actions. Over time the kleshas came to be seen as the very roots of samsaric existence.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>101, 'in_list'=>true)); ?>

<?php echo __('Three Poisons') ?>:
<ul class="in_text">
	<li><?php echo __('ignorance;') ?></li>
	<li><?php echo __('attachment;') ?></li>
	<li><?php echo __('craving.') ?></li>
</ul>
<br/>
<?php echo __('The Five Poisons, also known as the Five Disturbing Emotions are') ?>:
<ul class="in_text">
	<li><?php echo __('Passion (desire, greed, lust);') ?></li>
	<li><?php echo __('Aggression (anger, hatred, resentment);') ?></li>
	<li><?php echo __('Ignorance (bewilderment, confusion, apathy);') ?></li>
	<li><?php echo __('Pride (wounded pride, low-self esteem);') ?></li>
	<li><?php echo __('Jealousy (envy, paranoia).') ?></li>
</ul>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="mara"><?php echo ++$counter; ?>. <?php echo __('Mara') ?></h2>
<?php echo __('In Buddhism, Māra is the demon who tempted Siddartha Gautama the Buddha by trying to seduce him with the vision of beautiful women who, in various legends, are often said to be Mara\'s daughters. In Buddhist cosmology, Mara personifies unskillfulness, the "death" of the spiritual life. He is a tempter, distracting humans from practicing the spiritual life by making the mundane alluring or the negative seem positive.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>132)); ?>

<?php echo __('The early Buddhists, however, rather than seeing Mara as a demonic, virtually all-powerful Lord of Evil, regarded him as more of a nuisance. Many episodes concerning his interactions with the Buddha have a decidedly humorous air to them.') ?>
<br/><br/>

<?php echo __('In traditional Buddhism four senses of the word "mara" are given:') ?>
<br/><br/>
<ol class="in_text">
	<li><?php echo __('Klesa-mara, or Mara as the embodiment of all unskillful emotions.') ?></li>
	<li><?php echo __('Mrityu-mara, or Mara as death, in the sense of the ceaseless round of birth and death.') ?></li>
	<li><?php echo __('Skandha-mara, or Mara as metaphor for the entirety of conditioned existence.') ?></li>
	<li><?php echo __('Devaputra-mara, or Mara the son of a deva (god), that is, Mara as an objectively existent being rather than as a metaphor.') ?></li>
</ol>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="dharma"><?php echo ++$counter; ?>. <?php echo __('Dharma') ?></h2>
<?php echo __('Dharma (dhamma) is the term that means one\'s righteous duty, or any virtuous path. In Indian languages it can be equivalent simply to religion, depending on context. The word dharma translates as that which upholds or supports, and is generally translated into English as law.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>102)); ?>
<?php echo __('The Dharma, as the liberating law discovered and proclaimed by the Buddha, is summed up in the Four Noble Truths. Beings that live in accordance with Dharma proceed more quickly toward nirvana (personal liberation).') ?> 
<br/><br/>
<?php echo __('"Dharma" usually refers not only to the sayings of the Buddha, but also to the later traditions of interpretation and addition that the various schools of Buddhism have developed to help explain and to expand upon the Buddha\'s teachings. Dharma in the Buddhist scriptures has a variety of meanings, including "phenomenon" and "nature" or "characteristic".') ?> 
<br/><br/>
<?php echo __('For others still, they see the Dharma as referring to the "truth," or the ultimate reality of "the way that things really are". "dharma" is also used to infer one\'s duty in a righteous way; thus a Raja\'s dharma is to protect its people, a barber\'s dharma is to cut hair, a teacher\'s dharma is to teach. Dharma with a capital "D" (as opposed to thousands of dharmas or little ways and methods, with a little "d") means universal or absolute truth.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="sangha"><?php echo ++$counter; ?>. <?php echo __('Sangha') ?></h2>
<?php echo __('Sangha is a word in Pali or Sanskrit that can be translated roughly as "association" or "assembly," "company" or "community" with common goal, vision or purpose.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>103)); ?>
<?php echo __('There are three distinct definitions of Sangha') ?>:
<br/><br/>
<ol class="in_text">
	<li><?php echo __('all Buddhist practitioners;') ?></li>
	<li><?php echo __('community of ordained monks and nuns;') ?></li>
	<li><?php echo __('community of those who have attained enlightenment, who may help a practicing Buddhist to do the same.') ?></li>
</ol>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="refuge"><?php echo ++$counter; ?>. <?php echo __('Refuge') ?></h2>
<?php echo __('In Buddhism, instead of looking for any external savior, most Buddhists believe one can take refuge in oneself.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>104, 'in_list'=>true)); ?>
<?php echo __('Buddhists are said to "take refuge" in, or to "go for refuge" to, the Three Jewels ("Three Refuges")') ?>:
<ul class="in_text">
	<li><?php echo __('the Buddha, who, depending on one\'s interpretation, can mean the historical Buddha, Shakyamuni, or the Buddha nature — the ideal or highest spiritual potential that exists within all beings;') ?></li>
	<li><?php echo __('the Dharma;') ?></li>
	<li><?php echo __('the Sangha.') ?></li>
</ul>
<br/>
<?php echo __('The idea behind taking refuge is that when it starts to rain, we like to find a shelter. The Buddhist shelter from the rain of problems and pain of life is threefold: the Buddha, his teachings (the Dharma) and the spiritual community (the Sangha). Taking refuge means that we have some understanding about suffering, and we have confidence that the Buddha, Dharma and Sangha (the "Three Jewels") can help us.') ?>
<br/><br/>
<?php echo __('The analogy of sickness is often used: Buddha is the doctor, Dharma is the medicine, Sangha is the nurse, we are the patient, the cure is taking the medicine, which means practicing the methods. Taking refuge is like unpacking the medicine and deciding to follow the doctor\'s advice.') ?>
<br/><br/>
<div class="video_object">
<?php if ($sf_user->getCulture() == 'ru'): ?>
<OBJECT width="470" height="353"></PARAM></PARAM></PARAM><EMBED src="http://video.rutube.ru/eb0abb9aa539feec9474fd7514e50d17" type="application/x-shockwave-flash" wmode="window" width="470" height="353" allowFullScreen="true" ></EMBED></OBJECT>
<? else: ?>
<embed src="http://blip.tv/play/AYHY5QMC" type="application/x-shockwave-flash" width="480" height="350" allowscriptaccess="always" allowfullscreen="true"></embed>
<?php endif ?>
</div>
<?php echo __('Often, one who takes refuge will make vows as well, typically vows to adhere to the Five Precepts (panca-sila). The Five Precepts are not given in the form of commands such as "thou shall not ...", but rather are promises to oneself: "I will (try) ..."') ?>
<br/><br/>
<ol class="in_text">
	<li><?php echo __('To refrain from harming living creatures (killing).') ?></li>
	<li><?php echo __('To refrain from taking that which is not given (stealing).') ?></li>
	<li><?php echo __('To refrain from sexual misconduct.') ?></li>
	<li><?php echo __('To refrain from false speech.') ?></li>
	<li><?php echo __('To refrain from intoxicants which lead to loss of mindfulness.') ?></li>
</ol>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<?php /*
<h2 id="schools_and_traditions_of_buddhism"><?php echo ++$counter; ?>. <?php echo __('Schools and traditions of Buddhism') ?></h2>
<?php echo __('Buddhists generally classify themselves as either Theravada or Mahayana. An alternative scheme used by some scholars divides Buddhism into the following three traditions or geographical or cultural areas: Theravada, East Asian Buddhism and Tibetan Buddhism.') ?> 
<br/><br/>
<?php echo __('Hinayana ("Lesser Vehicle") is used by Mahayana followers to name the family of early philosophical schools and traditions from which contemporary Theravada emerged, but as this term is rooted in the Mahayana viewpoint and can be considered derogatory, a variety of other terms are increasingly used instead, including Nikaya Buddhism, early Buddhist schools, sectarian Buddhism, conservative Buddhism.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>105)); ?>
<?php echo __('Despite differences among the Theravada and Mahayana schools there are several concepts common to both major Buddhist branches') ?>: 
<br/><br/>
<ul class="in_text">
	<li><?php echo __('Both accept the Buddha as their teacher.') ?></li>
	<li><?php echo __('Both accept the Middle way, Dependent origination (nothing exists independently of other things), the Four Noble Truths, the Noble Eightfold Path and the Three marks of existence.') ?></li>
	<li><?php echo __('Both accept that members of the laity and of the sangha can pursue the path toward enlightenment (bodhi).') ?></li>
	<li><?php echo __('Both consider buddhahood to be the highest attainment') ?>.</li>
</ul>
<br/>
<?php echo __('There is Third Vehicle, Vajrayana, which is practiced in Tibetan Buddhism.') ?>

<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>

<h2 id="mahayana"><?php echo ++$counter; ?>. <?php echo __('Mahayana ("Great Vehicle")') ?></h2>
<?php echo __('Mahayana is one of two major divisions of Buddhism, along with Theravada.') ?> 
<br/><br/>
<?php echo __('The origins of Mahayana are still not completely understood. Although the Mahayana movement traces its origin to Gautama Buddha, scholars believe that it originated in India.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>106)); ?>
<?php echo __('Mahayana Buddhism in India can be divided into two periods: early Mahayana Buddhism and late Mahayana Buddhism. The earliest sutras which show some Mahayana influence are called the Proto-Mahayana Sutras such as the Ajitasena Sutra. These sutras contains a mixture of Mahayana and pre-Mahayana ideas. During the period of Late Mahayana Buddhism, four major types of thought developed: Madhyamaka, Yogacara, Tathagatagarbha, and Buddhist Logic as the last and most recent.') ?> 
<br/><br/>
<?php echo __('Mahayana Buddhist schools de-emphasize the ideal of the release from Suffering and the attainment of Nirvana, found in the Early Buddhist Schools. The fundamental principles of Mahayana doctrine were based around the possibility of universal liberation from suffering for all beings (hence "Great Vehicle") and the existence of Buddhas and Bodhisattva embodying Buddha-nature. Some Mahayana schools simplify the expression of faith by allowing salvation to be alternatively obtained through the grace of the Buddha Amitabha by having faith and devoting oneself to chanting to Amitabha.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>107)); ?>
<?php echo __('Mahayana Buddhism can in general be characterized by') ?>:
<br/><br/>
<ol class="in_text">
	<li><?php echo __('Universalism, in that everyone will become a Buddha (Lotus Sutra);') ?></li>
	<li><?php echo __('Bodhicitta (a wish to attain complete enlightenment, that is, Buddhahood) as the main focus of realization (Prajnaparamita Sutras);') ?></li>
	<li><?php echo __('Compassion through the transferral of merit;') ?></li>
	<li><?php echo __('Transcendental immanence, in that the immortal Buddha Principle is present within all beings (Mahaparinirvana Sutra, Angulimaliya Sutra, Srimala Sutra, Tathagatagarbha Sutra).') ?></li>
</ol>
<br/>
<?php echo __('Mahayana developed a rich cosmography, with various Buddhas and Bodhisattvas residing in paradisiacal realms. The concept of trinity, or trikaya, supports these constructions, making the Buddha himself into a transcendental figure.') ?> 
<br/><br/>
<?php echo __('The Trikaya doctrine ("Three bodies or personalities") is an important Buddhist teaching both on the nature of reality, and what a Buddha is. Briefly, the doctrine says that a Buddha has three kayas or bodies') ?>:
<br/><br/>
<ul class="in_text">
	<li><?php echo __('The Nirmanakāya is a physical body of a Buddha. An example would be Gautama Buddha\'s body.') ?></li>
	<li><?php echo __('The Sambhogakāya is the reward-body, whereby a bodhisattva completes his vows and becomes a Buddha. Amitabha, Vajrasattva and Manjushri are examples of Buddhas with the Sambhogakaya body.') ?></li>
	<li><?php echo __('the Dharmakaya (Truth body, Diamond body) which embodies the very principle of enlightenment and knows no limits or boundaries.') ?></li>	
</ul>
<br/>
<?php echo __('In the course of its history, Mahayana spread throughout Inner Asia and East Asia, where it took on two principal forms: Tibetan Buddhism and East Asian Buddhism. The late stage of Mahayana Buddhism in India are largely Vajrayana schools.') ?> 

<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>

<h2 id="tibetan_buddhism"><?php echo ++$counter; ?>. <?php echo __('Tibetan Buddhism') ?></h2>
<?php include_component('photo', 'show', array('id'=>108)); ?>
<?php echo __('Tibetan Buddhism is the body of Buddhist religious doctrine and institutions. It is practiced in Tibet, Nepal, Bhutan, India, Mongolia, Northeast China and parts of Russia (Kalmykia, Buryatia, and Tuva).') ?> 
<br/><br/>
<?php echo __('Tibetan Buddhism includes the teachings of the three vehicles of Buddhism: the Theravada, Mahayana, and Vajrayana.') ?> 
<br/><br/>
<?php echo __('In the 8th century, King Trisong Detsen (755-797) established Buddhism as the official religion of Tibet. He invited Indian Buddhist scholars to his court. In his age the famous tantric mystic Padmasambhava arrived in Tibet according to the Tibetan tradition. In addition to writing a number of important scriptures (some of which he hid for future tertons to find), Padmasambhava established the Nyingma school ("the old school").') ?> 
<br/><br/>
<?php echo __('Four schools of Tibetan Buddhism (Nyingma, Kagyu, Gelug, and Sakya) are using Vajrayana today.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="vajrayana"><?php echo ++$counter; ?>. <?php echo __('Vajrayana') ?></h2>
<?php echo __('Though based upon Mahayana, Tibetan Buddhism is one of the schools that practice Vajrayana, also known as Tantric Buddhism, Secret Mantra, Esoteric Buddhism and the Diamond Vehicle. The term "vajra" denoted the thunderbolt, a legendary weapon and divine attribute that was made from an adamantine, or indestructible substance and which could therefore pierce and penetrate any obstacle or obfuscation. As a secondary meaning, "vajra" refers to this indestructible substance, and so is sometimes translated as "adamantine" or "diamond". A vajra (dorje) is also a scepter-like ritual object, which has a sphere at its centre, and a variable number of spokes, enfolding either end of the rod. The vajra is often traditionally employed in tantric rituals. Symbolically, the vajra may represent method as well as great bliss.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>110)); ?>
<?php echo __('The goal of spiritual practice within the Mahayana and Vajrayana traditions is to become a bodhisattva, whereas the goal for Theravada practice is not specific to which type of enlightened being to become. As with the Mahayana, motivation is a vital component of Vajrayana practice, and Vajrayana teaches that all practices are to be undertaken with the motivation to achieve Buddhahood for the benefit of all sentient beings. Whereas Mahayana seeks to destroy the poisons of craving, aggression, and ignorance, Vajrayana places an emphasis on transmuting them directly into wisdom.') ?> 
<br/><br/>
<?php echo __('In addition to the Mahayana scriptures, Vajrayana Buddhists recognise a large body of Buddhist Tantras. The scriptures containing the esoteric teachings for yogic practices (such as meditative visualizations) are called tantras, and are part of a larger body of Buddhist sacred texts, based on the public teachings of the Buddha, called sutras. In the Tibetan tradition, it is claimed that the historical Śākyamuni Buddha taught tantra, but as these are esoteric teachings, they were passed on orally first and only written down long after the Buddha\'s other teachings. One component of the Vajrayana is harnessing psycho-physical energy through ritual, tantric visualization, physical exercises, and meditation as a means of developing the mind.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>109)); ?>
<?php echo __('Using Vajrayana techniques, it is claimed that a practitioner can achieve Buddhahood in one lifetime, or even as little as three years. Vajrayana is said to be the fastest method for attaining Buddhahood but for unqualified practitioners it can be dangerous. To engage in Vajrayana one must receive an appropriate initiation (also known as an "empowerment") from a lama who is fully qualified to give it.') ?> 
<br/><br/>
<?php echo __('Vajrayana Buddhism is esoteric, in the sense that the transmission of certain teachings only occurs directly from teacher to student during an initiation or empowerment and cannot be simply learned from a book. Many techniques are also commonly said to be secret. The degree to which information on Vajrayana is now public in western languages is controversial among Tibetan Buddhists. In Buddhist teachings generally, too, there is caution about revealing information to people who may be unready for it.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="the_sakya_tradition"><?php echo ++$counter; ?>. <?php echo __('The Sakya Tradition in Tibetan Buddhism') ?></h2>
<?php echo __('The Sakya school is one of four major schools of Tibetan Buddhism. It rose to play a significant role in the development and spread of the new Tantras that came to Tibet in the 11th century.') ?> 
<br/><br/>
<?php echo __('The origins of the Sakya tradition are closely connected with the ancestral lineage of the Khön family: a family which itself originated from celestial beings.') ?> 
<br/><br/>
<?php echo __('The name Sakya ("pale earth") derives from the unique grey landscape of Ponpori Hills in southern Tibet near Shigatse, where Sakya Monastery, the first monastery of this tradition, and the seat of the Sakya School was built by Khon Konchog Gyalpo (1034-1102) in 1073.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>111)); ?>
<?php echo __('The Five Patriarchs of the Sakya Traditon: Sachen Künga Nyingpo, Loppön Sonam Tsemo, Jetsün Drakpa Gyaltsen, Sakya Pandita, and Drogön Chogyal Phagpa.') ?> 
<br/><br/>
<?php echo __('The head of the Sakya school, known as Sakya Trizin ("holder of the Sakya throne"), is always drawn from the male line of the Khön family. The present Sakya Trizin, Ngawang Kunga Tegchen Palbar Samphel Wanggi Gyalpo, born in Tsedong in 1945, is the forty-first to hold that office. 41st Sakya Trizin is the reincarnation of two great Tibetan masters: a Nyingmapa lama known as Apong Terton (Orgyen Thrinley Lingpa), who is famous for his Red Tara cycle, and his grandfather, the 39th Kyabgon Sakya Trizin Dhagtshul Thrinley Rinchen (1871 - 1936).') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>112)); ?>
<?php echo __('The teaching and practice that is the essence of the Sakya tradition is called “Lamdre” or “The Path and its Fruit.” Fundamentally, the philosophical viewpoint expressed in “The Path and its Fruit,” is the “Non differentiation of Samsara and Nirvana.” According to this view, an individual cannot attain Nirvana or cyclic existence, because the mind is the root of both Samara and Nirvana. When the mind is obscured, it takes the form of Samsara and when the mind is freed of obstructions, it takes the form of Nirvana. The ultimate reality is that a person must strive to realize this fundamental inseparability through mediation.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
*/ ?>
<h2 id="tummo"><?php echo ++$counter; ?>. <?php echo __('Tummo') ?></h2>
<?php echo __('Tummo (Tibetan: gtum-mo, also spelled Tumo, or Tum-mo; Sanskrit: caṇḍālī) is a Tibetan word, literally meaning fierce, inner fire. The Sanskrit terms caṇḍālī and kuṇḍalinī are clearly etymologically related.') ?> 
<br/><br/>
<?php echo __('The practices are taught in a suite of Six Yogas of Naropa, which describe contemplative practices, spiritual energetic work or meditations such as those used in the Himalayan traditions of Vajrayana and Bön. This discipline is key to all advanced (completion stage) spiritual practices in Tibetan Buddhism.') ?> 
<br/><br/>
<?php echo __('The Tummo practices were first described in writing by the Indian yogi and Buddhist scholar Naropa, although the Tibetan Buddhist tradition holds that the practice was actually taught by Shakyamuni Buddha and passed down orally until the time of Naropa. The Tummo practice is also found in the Tibetan Bön lineage. One of the most famous practitioners of Tummo according to the Tibetan tradition was held to be Milarepa.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>136)); ?>
<?php echo __('Tummo-meditation is commonly associated with descriptions of intense sensations of body heat, which are a partial effect, rather than a goal, of the practice. Stories and eyewitness accounts abound of yogi practitioners being able to generate sufficient heat to dry wet sheets draped around their naked bodies while sitting outside in the freezing cold. While the physiological effects of Tummo are well known, they are not the primary purpose of the meditation practice. Tummo is a tantric meditation practice that transforms and evolves the consciousness of the practitioner so that "wisdom" (prajna) and "compassion" (karuna) are manifested in the individual.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>137)); ?>
<?php echo __('Not unproblematic, Tummo must be practiced in conjunction with appropriate empowerment and under the direction of a traditionally qualified Tantric Guru. Extensive preparation and pure motivation, most specifically bodhichitta, are absolutely essential both to beneficial results and to the avoidance of physical pain and discomfort in rlung (wind or breath) disorder or other imbalances.') ?> 
<br/><br/>
<?php echo __('The Buddhist tantric systems present several different models of the chakras, and for tummo the "energetic winds" (prana, rlung) are being accumulated at the navel chakra, four fingers below the navel. In Tibetan Buddhism the primary purpose of Tummo is to gain control over subtle body processes as a foundation for very advanced mystical practices analogous to Completion stages of "highest yoga tantra" (Anuttarayoga Tantra). Such refined internalized yogas are practices to support entry into the highest contemplative systems, for example the Dzogchen or Mahamudra systems.') ?> 
<br/><br/>
<?php //include_component('photo', 'show', array('id'=>115)); ?>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="bodhisattva"><?php echo ++$counter; ?>. <?php echo __('Bodhisattva') ?></h2>
<?php include_component('photo', 'show', array('id'=>114)); ?>
<?php echo __('Bodhisattva means either "enlightened (bodhi) existence (sattva)" or "enlightenment-being" or "heroic-minded one (satva) for enlightenment (bodhi)". Another translation is "Wisdom-Being". It is the name given to anyone who, motivated by great compassion, has generated bodhicitta, which is a spontaneous wish to attain Buddhahood for the benefit of all living beings.') ?> 
<br/><br/>
<?php echo __('The various divisions of Buddhism understand the word Bodhisattva in different ways. Theravada and some Mahayana sources consider a Bodhisattva as someone on the path to Buddhahood, while other Mahayana sources speak of Bodhisattvas renouncing Buddhahood. But especially in Mahayana Buddhism, it mainly refers to a being that compassionately refrains from entering nirvana in order to save others. So the Bodhisattva is a person who already has a considerable degree of enlightenment and seeks to use their wisdom to help other sentient beings to become liberated themselves.') ?> 
<br/><br/>
<?php echo __('While Theravada regards it as an option, Mahayana encourages everyone to follow a Bodhisattva path and to take the Bodhisattva vows. With these vows, one makes the promise to work for the complete enlightenment of all sentient beings.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>115, 'in_list'=>true)); ?>
<?php echo __('The Bodhisattva Path') ?>:
<br/><br/>
<ol class="in_text">
	<li><?php echo __('One hears the Dharma.') ?></li>
	<li><?php echo __('Inspired by the Dharma, one performs good deeds and accepts the grace of others (e.g., teachers, bodhisattvas), thus benefiting from their merit and building one\'s own merit.') ?></li>
	<li><?php echo __('One develops the "thought of enlightenment" (bodhicitta), which') ?>
		<ul class="padded">
			<li><?php echo __('cancels previous bad karma') ?></li>
			<li><?php echo __('stimulates the development of merit') ?></li>
			<li><?php echo __('ensures good rebirths.') ?></li>
		</ul>
	</li>
	<li><?php echo __('One takes the bodhisattva vows, which become a driving force - a personal destiny that leads one higher and higher.') ?></li>
	<li><?php echo __('One practices the six perfections.') ?></li>
</ol>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="six_paramitas"><?php echo ++$counter; ?>. <?php echo __('Six paramitas (perfections)') ?></h2>
<ol class="in_text">
	<li><?php echo __('Dāna paramita - self-sacrifice, transfer of one\'s own merit to others;') ?></li>
	<li><?php echo __('Śīla paramita - virtue, morality, discipline, proper conduct;') ?></li>
	<li><?php echo __('Ksānti (kshanti) paramita (patience) - not becoming disturbed or agitated by anyone or anything, having faith in such doctrines as shunyata, "emptiness", practicing forgiveness;') ?></li>
	<li><?php echo __('Vīrya paramita (right effort);') ?></li>
	<li><?php echo __('Dhyāna paramita (meditation);') ?></li>
	<li><?php echo __('Prajñā paramita (wisdom) - at this stage ("the Perfection of Wisdom"), the bodhisattva could, if he/she chose to do so, leave samsara and enter nirvana. But out of compassion for others, he/she continues to work in this world...;') ?><br/>
<?php echo __('Stages one through six of the bodhisattva path constitute the practices of ordinary bodhisattvas, e.g., humans like us who are trying to perfect ourselves in hopes of nirvana. But, once one has freed oneself from the attachments that bind one in samsara, there are four additional stages, which constitute the practices of "cosmic bodhisattvas" (such as Avalokitesvara and Manjushri)') ?>:
	</li>
	<li>
		<?php echo __('"going far" - practicing the ten perfections, i.e., the six mentioned above and four more:') ?>
		<ul class="padded">
			<li><?php echo __('Upāya (skillful means, contrivances, devices) - any method used to help others progress along the path. For instance, one might describe the Pure Land as though it is a material place where jewels hang from trees, in order to arouse the listener\'s interest. The successful bodhisattva is said to practice "skill in means" (upaya-kaushalya), continually leading others toward perfection. Ultimately, of course, all presentations of the Dharma - inwords or symbols - merely constitute upaya, expediencies.') ?></li>
			<li><?php echo __('Pranidhāna (pranidhana) paramita - steadfastness in one\'s "vow".') ?></li>
			<li><?php echo __('Bala - "strength" in practicing the perfections.') ?></li>
			<li><?php echo __('Jñāna - "knowledge", that one\'s practices are correct and effective.') ?></li>
		</ul>
	</li>
	<li><?php echo __('acala - "immovable", the ability to achieve one\'s goals spontaneously, by pure will;') ?></li>
	<li><?php echo __('sadhumati - "good intelligence", apparently, a higher order of prajñā paramita;') ?></li>
	<li><?php echo __('dharmamegha - "clouds of Dharma": total perfection, like that of the Tathagata, bathed (as it were) in clouds of wisdom and virtue.') ?></li>
</ol>
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="dhyana"><?php echo ++$counter; ?>. <?php echo __('Dhyana') ?></h2>
<?php echo __('Dhyāna is usually translated as "concentration," "meditation," or "meditative stability." Dhyāna is the fifth of six pāramitās (perfections).') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>116)); ?>
<?php echo __('In the Pali Canon the Buddha describes eight progressive states of absorption meditation or jhāna. Four are considered to be meditations of form and four are formless meditations. The first four jhānas are said by the Buddha to be conducive to a pleasant abiding and freedom from suffering. The deeper jhānas can last for many hours. When a meditator emerges from jhāna, his or her mind is empowered and able to penetrate into the deepest truths of existence.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="arhat"><?php echo ++$counter; ?>. <?php echo __('Arhat') ?></h2>
<?php echo __('Arhat (Sanskrit) or arahant (Pali) is a spiritual practitioner who had "laid down the burden", realizing the goal of nirvana, the culmination of the spiritual life. In early Buddhist scriptures, the word arahant refers to an enlightened being. The exact interpretation and etymology this word remains disputed.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>117)); ?>
<?php echo __('In Theravada, it means anyone who has reached the total Awakening and attained Nibbana, including the Buddha. Arahant is a person who has destroyed greed, hatred and delusion, the unwholesome roots which underlie all fetters. Who upon decease will not be reborn in any world, having wholly cut off all fetters that bind a person to the samsara. In the Pali Canon, the word is sometimes used as a synonym for tathagata.') ?> 
<br/><br/>
<?php echo __('In Mahayana, it usually means anyone who has destroyed greed and hatred, but is still subject to delusion. According to most, but not all, Mahayana authorities, an Arhat must go on to become a Bodhisattva. If they fail to do so in the lifetime in which they attain the enlightenment, they will go to some sort of dormant state, thence to be roused and taught the Bodhisattva path, presumably when ready.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="anuttara_samyak_sambodhi"><?php echo ++$counter; ?>. <?php echo __('Samyak Sambodhi (Anuttara-samyak-sambodhi)') ?></h2>
<?php echo __('Anuttara means supreme, highest, incomparable, unsurpassed, or peerless. Samyak means right, correct, true, accurate, complete, or perfect, and sambodhi means enlightenment. The expression Samyak Sambodhi by itself is also used to mean perfect enlightenment. Bodhi and sambodhi also mean wisdom or perfect wisdom. In this sense, anuttara-samyak-sambodhi means supreme perfect wisdom.') ?> 
<br/><br/>
<?php echo __('Anuttara-samyak-sambodhi (Sanskrit) is a supreme perfect enlightenment, the unsurpassed enlightenment of a Buddha; the unsurpassingly merciful and enlightened heart; applied to liberated, perfected beings collectively, who then may "pass through all the six worlds of Being (Rupaloka) and get into the first three worlds of Arupa."') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>130)); ?>
<?php echo __('The Diamond Sutra:') ?> 
<br/><br/>

<?php echo __('"The Bodhisattva Way is cultivated by those who seek the great fruit. Foreign lands are not sought after, because Bodhisattvas are not small landlords who set about conquering other countries in order to build an empire. Only Anuttarasamyaksambodhi, the highest fruit of cultivation, is the goal of great beings."') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="maitreya"><?php echo ++$counter; ?>. <?php echo __('Maitreya') ?></h2>
<?php echo __('Maitreya (Sanskrit), Metteyya (Pāli), or Yampa (Tibetan) is a bodhisattva who in the Buddhist tradition is to appear on Earth, achieve complete enlightenment, and teach the pure dharma. According to scriptures, Maitreya will be a successor of the historic Śākyamuni Buddha, the founder of Buddhism.') ?> 
<br/><br/>
<?php echo __('The name Maitreya is derived from the word Maitri (Sanskrit) or Metta (Pali) meaning "loving-kindness".') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>118)); ?>
<?php echo __('Maitreya currently resides in the Tusita Heaven, said to be reachable through meditation. Sakyamuni Buddha also lived here before he was born into the world as all bodhisattvas live in the Tusita Heaven before they descend to the human realm to become Buddhas.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="asanga"><?php echo ++$counter; ?>. <?php echo __('Asanga') ?></h2>
<?php echo __('Asanga was one of the most famous Indian Buddhist saints, and lived in the fourth century. He went to the mountains to do a solitary retreat, concentrating all his meditation practice on the Buddha Maitreya, in the fervent hope that he would be blessed with a vision of this Buddha and receive teachings from him.') ?> 
<br/><br/>
<?php echo __('For several years Asanga meditated in extreme hardship without the slightest sign from the Buddha Maitreya.') ?> 
<br/><br/>
<?php echo __('The day wore on, he came across a dog lying by the side of the road. It had only its front legs, and the whole of the lower part of its body was rotting and covered with maggots. Despite its pitiful condition, the dog was snapping at passers-by and pathetically trying to bite them by dragging itself along the ground with its two good legs.') ?> 
<br/><br/>
<?php echo __('Asanga was overwhelmed with a vivid and unbearable feeling of compassion. He cut a piece of flesh off his own body and gave it to the dog to eat. Then he bent down to take off the maggots that were consuming the dog\'s body. But he suddenly thought he might hurt them if he tried to pull them out with his fingers, and realized that the only way to remove them would be on his tongue. Asanga knelt on the ground, and looking at the horrible festering, writhing mass, closed his eyes. He leant closer and put out his tongue. The next thing he knew, his tongue was touching the ground. He opened his eyes and looked up. The dog was gone; there in its place was the Buddha Maitreya, ringed by a shimmering aura of light.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>119)); ?>
<?php echo __('"At last," said Asanga, "why did you never appear to me before?"') ?> 
<br/><br/>
<?php echo __('Maitreya spoke softly: "It is not true that I have never appeared to you before. I was with you all the time, but your negative karma and obscurations prevented you from seeing me. Your twelve years of practice dissolved them slightly so that you were at last able to see the dog. Then, thanks to your genuine and heartfelt compassion, all those obscurations were completely swept away and you can see me before you with your very own eyes."') ?> 
<br/><br/>
<?php echo __('Then the Buddha Maitreya took Asanga to the Tusita Heaven, and there gave him many sublime teachings that are among the most important in the whole of Buddhism.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="the_future_coming_of_maitreya"><?php echo ++$counter; ?>. <?php echo __('The future coming of Maitreya') ?></h2>
<?php echo __('Maitreya is prophesied by the Buddha Shakyamuni to be the next Buddha to appear in our world system. He will be last of the the five Buddhas to gain Supreme Enlightenment in this kalpa (aeon, long period of time).') ?> 
<br/><br/>
<?php echo __('Maitreya\'s coming will occur after the teachings of the current Gautama Buddha, the Dharma, are no longer taught and are completely forgotten. Gautama predicts that when man\'s life span is eighty thousand years he who is named Maitreya shall arise in the world.') ?> 
<br/><br/>
<?php echo __('Gautama Buddha prophesied the advent of a future Buddha who would restore the true teaching and establish the next golden age. He shall proclaim the Teaching pleasant in its beginning, pleasant in the middle, and pleasant in the end thereof, and shall make known its spirit and its letter: in its perfection and in all its purity.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>120)); ?>
<?php echo __('Sutra of Maitreya Bodhisattva\'s Attainment of Buddhahood:') ?> 
<br/><br/>

<?php echo __('The one with unsurpassed virtue') ?> 
<br/><br/>

<?php echo __('Will rightfully appear in the world.') ?> 
<br/><br/>

<?php echo __('That one will pronounce the wondrous Dharma,') ?> 
<br/><br/>

<?php echo __('And all will be infused with it,') ?> 
<br/><br/>

<?php echo __('Like the thirsty drinking the sweet nectar.') ?> 
<br/><br/>

<?php echo __('All will swiftly set off on the Liberation Path.') ?> 
<br/><br/>

<?php echo __('Many Buddhist texts contain variations of the legend that Mahakasyapa, a disciple of Gautama Buddha who took over the leadership of the Sangha after Gautama\'s passing, is in deep meditation inside a mountain awaiting the coming of Maitreya so that he can pass him Gautama\'s robe. Gautama Buddha instructed four of his disciples, Mahakasyapa, Kundopadhaniya, Pindola, and Rahula, not to enter nirvana, but instead to remain in the world until Maitreya appears: "You must wait for my Law to come to its end, then you may enter nirvana." Sakyamuni particularly singles out Mahakasyapa.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<?php /*
<h2 id="buddha_nature"><?php echo ++$counter; ?>. <?php echo __('Buddha-nature') ?></h2>
<?php echo __('Within many schools of Mahayana Buddhism, the Buddha-nature or Buddha Principle (Buddha-dhātu), is taught to be a truly real and pure, but internally hidden immortal potency or element within the mind of all beings, for awakening and becoming a Buddha. Other terms for the Buddha-nature are Tathāgatagarbha and Sugatagarbha.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>138)); ?>
<?php echo __('The Mahayana Uttaratantra Shastra, one of the "Five Treatises" said to have been dictated to Asanga by the Maitreya, presents the Buddha\'s definitive teachings on how we should understand this ground of enlightenment and clarifies the nature and qualities of buddhahood.') ?> 
<br/><br/>
<?php echo __('Buddha-nature is completely rejected by Theravada Buddhism due to the fact that the concept comes from later Mahayana sutras which it sees as inauthentic.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
*/ ?>
<h2 id="atman"><?php echo ++$counter; ?>. <?php echo __('Atman (Buddhism)') ?></h2>
<?php echo __('Atman or Atta (Pāli) literally means "self", but is sometimes translated as "soul" or "ego". In Buddhism, the belief in the existence of an unchanging ātman is the prime consequence of ignorance, which is itself the cause of all misery and the foundation of samsāra.') ?> 
<br/><br/>
<?php echo __('With the doctrine of anatta Buddhism maintains that the concept of atman is unnecessary and counterproductive as an explanatory device for analyzing action, causality, karma, and rebirth. Buddhists regard postulating the existence of atman as undesirable, as they believe it provides the psychological basis for attachment and aversion.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>123)); ?>
<?php echo __('While the suttas criticize notions of an eternal, unchanging Self, they see an enlightened being as one whose changing, empirical self is highly developed. One with great self has a mind which is not at the mercy of outside stimuli or its own moods, but is imbued with self-control, and self-contained. The mind of such a one is without boundaries, not limited by attachment or I-identification. One can transform one\'s self from an "insignificant self" into a "great self" through practices such as loving-kindness and mindfulness. The suttas portray one disciple who has developed his mind through loving-kindness saying: "Formerly this mind of mine was limited, but now my mind is immeasurable."') ?> 
<br/><br/>
<?php echo __('At the culmination of the path is the Arahant, described as "one of developed self", who has carried the process of personal development and self-reliance to its perfection. Such a person has developed all the good aspects of their personality. An arahant is described as "one with a mind like a diamond", it can "cut" anything and is itself uncuttable; nothing can affect it.') ?> 
<br/><br/>
<?php echo __('Śāntideva (an 8th-century Indian Buddhist philosopher and practitioner) informs us that in order to be able to deny something, we first of all need to know what it is that we are denying:') ?> 
<br/><br/>

<?php echo __('"Without contacting the entity that is imputed') ?><br/>
<?php echo __('You will not apprehend the absence of that entity"') ?> 
<br/><br/>
<?php echo __('In 2005, commenting on the Tibetan Book of the Dead, the 14th Dalai Lama explains how Highest Yoga Tantra Buddhism (of which the Tibetan Book of the Dead is a manifestation) conceives both of a temporary person, and a subtle person or self, which Highest Yoga Tantra - the Dalai Lama states - links to the Buddha Nature. He writes:') ?> 
<br/><br/>

<?php echo __('‘… when we look at [the] interdependence of mental and physical constituents from the perspective of Highest Yoga Tantra, there are two concepts of a person. One is the temporary person or self, that is as we exist at the moment, and this is labeled on the basis of our coarse or gross physical body and conditioned mind, and, at the same time, there is a subtle person or self which is designated in dependence on the subtle body and subtle mind. This subtle body and subtle mind are seen as a single entity that has two facets. The aspect which has the quality of awareness, which can reflect and has the power of cognition, is the subtle mind. Simultaneously, there is its energy, the force that activates the mind towards its object – this is the subtle body or subtle wind. These two inextricably conjoined qualities are regarded, in Highest Yoga Tantra, as the ultimate nature of a person and are identified as buddha nature, the essential or actual nature of mind.’') ?> 
<br/><br/>
<?php echo __('Moreover, the Buddhist tantric scripture entitled "Chanting the Names of Mañjusri", as quoted by the great Tibetan Buddhist master, Dolpopa, repeatedly exalts not the non-Self but the Self and applies the following terms to this ultimate reality:') ?> 
<ul class="padded">
	<li><?php echo __('"the pervasive Lord" (vibhu)') ?></li>
	<li><?php echo __('"Buddha-Self"') ?></li>
	<li><?php echo __('"the beginningless Self" (anādi-ātman)') ?></li>	
	<li><?php echo __('"the Self of Thusness" (tathatā-ātman)') ?></li>	
	<li><?php echo __('"the Self of primordial purity" (śuddha-ātman)') ?></li>	
	<li><?php echo __('"the Source of all"') ?></li>	
	<li><?php echo __('"the Self pervading all"') ?></li>	
	<li><?php echo __('"the Single Self" (eka-ātman)') ?></li>	
	<li><?php echo __('"the Diamond Self" (vajra-ātman)') ?></li>	
	<li><?php echo __('"the Solid Self" (ghana-ātman)') ?></li>	
	<li><?php echo __('"the Holy, Immovable Self"') ?></li>	
	<li><?php echo __('"the Supreme Self"') ?></li>	
</ul>
<br/>
<?php echo __('The Mahayana Mahaparinirvana Sutra has the Buddha speak of four essential elements which make up Nirvana. One of these is ‘Self’ (atman), which is construed as the enduring Self of the Buddha.') ?> 
<br/><br/>
<?php echo __('Within the Mahayana there exists an important class of sutras, generally known as Tathagatagarbha sutras, a number of which affirm that, in contradistinction to the impermanent "mundane self" of the five "skandhas"(the physical and mental components of the mutable ego), there does exist an eternal True Self, which is in fact none other than the Buddha himself in his ultimate "Nirvanic" nature. This is the "true self" in the self of each being, the ideal personality, attainable by all beings due to their inborn potential for enlightenment. The "tathagatagarbha"/Buddha nature does not represent a substantial self (atman); rather, it is a positive language and expression of "sunyata" (emptiness) and represents the potentiality to realize Buddhahood through Buddhist practices.') ?> 
<br/><br/>
<?php echo __('In the Dhammapada, one of the most respected texts of the Southern Buddhists, we read: "The self is the master of the self, for who else could be its master?".') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>127)); ?>
<?php echo __('Acharya Nagarjuna, one of the most important figures of early Buddhism, sometimes referred to as "the Second Buddha", in his commentary on the Prajnaparamita wrote: "Sometimes the Tathagata taught that the Atman verily exists, and yet at other times he taught that the Atman does not exist".') ?> 
<br/><br/>
<?php echo __('Buddhism greatly influenced the development of the Hindu Advaita Vedanta school of philosophy. There too there the individual self is deconstructed. Advaita however postulates the existence of a monistic metaphysical being in itself, i.e. Brahman or Paramatman as part of its interpretation of the Upanishads, while Buddhism does not.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="atman_hinduism"><?php echo ++$counter; ?>. <?php echo __('Atman (Hinduism)') ?></h2>
<?php echo __('The Ātman is a philosophical term used within Hinduism, especially in the Vedanta school to identify the soul whether in global sense (world\'s soul) or in individual sense (of a person own soul). It is one\'s true self (hence generally translated as "Self") beyond identification with the phenomenal reality of worldly existence.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="anatman"><?php echo ++$counter; ?>. <?php echo __('Anatta (Anatman, "not-self")') ?></h2>
<?php echo __('One of the central tenets of Buddhism, is the denial of a separate permanent "I", and is outlined in the three marks of existence.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>122, 'in_list'=>true)); ?>
<?php echo __('Anattā: "not-self," egolessness, impersonality. This doctrine teaches that neither in the material phenomena of the body, which are of four kinds (referred to collectively as "form" or materiality):') ?> 
<br/><br/>
<ul class="padded">
	<li><?php echo __('fluidity') ?></li>
	<li><?php echo __('heat') ?></li>
	<li><?php echo __('support') ?></li>	
	<li><?php echo __('solidity') ?></li>	
</ul>

<?php echo __('nor in the mental phenomena (referred to as "mind" or mentality), which are of four kinds:') ?> 
<br/><br/>
<ul class="padded">
	<li><?php echo __('sensation') ?></li>
	<li><?php echo __('perception') ?></li>
	<li><?php echo __('intention') ?></li>	
	<li><?php echo __('consciousness') ?></li>	
</ul>
<br/>
<?php echo __('is there to be found anything that in the ultimate sense can be regarded as an enduring self, ego, soul, identity, essence, or personality. There is no abiding substance.') ?> 
<br/><br/>
<?php echo __('Whosoever has not penetrated the impersonality of all existence, and does not comprehend that in reality there exists only this continually self-consuming process of arising and passing bodily and mental phenomena, and that there is no separate ego-entity within or without this process, will not be able to understand Buddhism, that is, the teaching of the Four Noble Truths, in the right light.') ?> 
<br/><br/>
<?php echo __('Instead, one will think that it is one\'s ego, one\'s personality that experiences suffering, one\'s personality that performs wholesome and unwholesome actions (karma), and that will be reborn according to these actions. One will think that it is one\'s personality that will "enter" into nirvana, one\'s personality that walks the Noble Eightfold Path.') ?> 
<br/><br/>
<?php echo __('The Discourse on the Characteristic of Not-self was the Buddha\'s second discourse after enlightenment, delivered the first five disciples. After hearing it, they attained full enlightenment (arhatship).') ?> 
<br/><br/>
<?php echo __('The contemplation of not-self leads to the emptiness liberation. Herein the faculty of wisdom is outstanding. And one who attains the path of stream-entry in that way is called a Dharma-devotee. At the next two stages of enlightenment, one becomes a vision-attainer. And at the highest stage (arhatship) one is called "liberated by wisdom".') ?> 
<br/><br/>
<?php echo __('In the Diamond Sūtra it says: "If a bodhisattva abides in the signs of self, person, sentient being, or life-span, she or he is not a bodhisattva."') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="paramatman"><?php echo ++$counter; ?>. <?php echo __('Paramatman (Supersoul)') ?></h2>
<?php include_component('photo', 'show', array('id'=>124)); ?>
<?php echo __('In Hindu theology, Paramatman or Paramātmā is the Absolute Atman or Supreme Soul or Spirit (also known as Supersoul or Oversoul) in the Vedanta and Yoga philosophies of India.') ?> 
<br/><br/>
<?php echo __('Paramatman is one of the aspects of Brahman. The Upanishads compare Atman and Paramatman to two birds sitting like friends on the branch of a tree (body). The Atman eats its fruits (karma), and the Paramatman only observes the Atman as a witness of His friend\'s actions.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<?php /*
<h2 id="god_in_buddhism"><?php echo ++$counter; ?>. <?php echo __('God in Buddhism') ?></h2>
<?php echo __('A common misconception among non-Buddhists is that the Buddha is the Buddhist counterpart to "God." Buddhism however, is in general non-theistic, in the sense of not teaching the existence of a supreme creator god or depending on any supreme being for enlightenment. The Buddha is a guide and teacher who points the way to enlightenment, however the struggle for enlightenment is one\'s own. The commonly accepted definition of the term "God" is of a being who rules and created the universe. The Buddha of the early texts gives arguments refuting the existence of such a being.') ?> 
<br/><br/>
<?php echo __('In early Buddhism, the Buddha clearly states that "reliance and belief" in creation by a supreme being leads to lack of effort and inaction. This is a significant hindrance in the path to liberation in the Buddha\'s view. It may be noted that the Buddha did not criticize veneration of the God, but only said that the belief in the existence of a creator God fetters the mind to samsara.') ?> 
<br/><br/>
<?php echo __('Mahayana Buddhism (like Theravada Buddhism) posits no Creator or ruler God. In the Avatamsaka Sutra it says, "If you want to understand all the Buddhas of the past, present, and future, then you should view the whole universe as being created by Heart." In some major traditions of Mahayana Buddhism (the Tathagatagarbha and Pure Land streams of teaching) there is a notion of the Buddha as the omnipresent, omniscient, liberative essence of reality, and Buddhas are spoken of as generators of vast "pure lands", "Buddha lands", or "Buddha paradises", in which beings will unfailingly attain Nirvana. And thus, to some extent, this conception of the Buddha draws close to pantheistic conceptions of godhead, yet it differs in that in the Mahayana tradition, anyone can become a Buddha, as compared to general theistic religions in which it is generally considered impossible to become a god or God.') ?> 
<br/><br/>
<?php echo __('Buddhism is neither atheistical nor theistical, and Buddhism is not a mixture of both either. Because the Buddhist teachings do not dwell in either one, thus it is called the Middle Way.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
*/ ?>
<h2 id="bhagavan"><?php echo ++$counter; ?>. <?php echo __('Bhagavan') ?></h2>
<?php echo __('Bhagavan (Bhagwan or Bhagawan) in Hindi and Sanskrit means one who is clad in bhagwa i.e. light orange colour, that represents gyan or knowledge. Thus Bhagwān means one who wears gyan or knowledge.') ?> 
<br/><br/>
<?php echo __('In some traditions of Hinduism it is used to indicate the Supreme Being or Absolute Truth, but with specific reference to that Supreme Being as possessing a personality (a personal God). This personal feature indicated in Bhagavan differentiates its usage from other similar terms such as Brahman, the "Supreme Spirit" or "spirit", and thus, in this usage, Bhagavan is in many ways analogous to the general Christian conception of God.') ?> 
<br/><br/>
<?php echo __('In Hindu Religion, the word Bhagwan has symbolic meaning too. The word encompasses Earth, Water, Fire, Air and Space – the five elements:') ?> 
<br/><br/>
<?php echo __('‘Bh’ stands for Bhoomi or Earth') ?>
<br/><br/>
<?php echo __('‘G’ stands for Gagan or Space') ?>
<br/><br/>
<?php echo __('‘V’ stands for Vayu or Air') ?>
<br/><br/>
<?php echo __('‘A’ stands for Agni or Fire') ?>
<br/><br/>
<?php echo __('‘N’ stands for Neer or Water') ?>
<br/><br/>
<?php echo __('Bhagavan used as a title of veneration is often translated as "Lord", as in "Bhagavan Krishna", "Bhagavan Shiva", "Bhagavan Swaminarayan", etc. In Buddhism and Jainism, Gautama Buddha, Mahavira and other Tirthankaras, Buddhas and bodhisattvas are also venerated with this title.') ?> 
<br/><br/>
<?php echo __('The title is also used as a respectful form of address for a number of contemporary spiritual teachers in India.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="gyani"><?php echo ++$counter; ?>. <?php echo __('Gyani') ?></h2>
<?php echo __('In the Hindu religion, Gyani is a person trying to perceive Absolute Truth (Bhagavan or Brahman) relying just on the strength of his mind.') ?> 
<br/><br/>
<?php echo __('The word "Ghian" in Punjabi means knowledge. So a "Ghiani" is someone who has spiritual and religious knowledge and can help the congregation.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="kali_yuga"><?php echo ++$counter; ?>. <?php echo __('Kali Yuga') ?></h2>
<?php include_component('photo', 'show', array('id'=>125)); ?>
<?php echo __('Kali Yuga ("age of vice") is the last of the four stages that the world goes through as part of the cycle of yugas described in the Indian scriptures. The "Kali" of Kali Yuga means "strife, discord, quarrel, or contention." The other ages are Satya Yuga, Treta Yuga and Dvapara Yuga. Most interpreters of Hindu scriptures believe that earth is currently in Kali Yuga. The Kali Yuga is traditionally thought to last 432,000 years.') ?> 
<br/><br/>
<?php echo __('Hindus believe that human civilization degenerates spiritually during the Kali Yuga, which is referred to as the Dark Age because in it people are as far removed as possible from God. Hinduism often symbolically represents morality (dharma) as a bull. In Satya Yuga, the first stage of development, the bull has four legs, but in each age morality is reduced by one quarter. By the age of Kali, morality is reduced to only a quarter of that of the golden age, so that the bull of Dharma has only one leg.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="tamang"><?php echo ++$counter; ?>. <?php echo __('Tamang') ?></h2>
<?php echo __('The Tamang (also known as Murmi) are one of the several ethnic groups from north central hilly region of Nepal. The word Tamang may be derived from the Tibetan words "ta" and "mang", meaning horse and soldier respectively. Living mainly north and east of the country, they constitute 5.6% of Nepal\'s population, which places their population at 1,280,000, slightly higher than the Newars.') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>128)); ?>
<?php echo __('The name Tamang, normally it is Tamag in Tibetan, means horse warriors, Tamags were border police sent by king Trisong of Tibet around 755. They are also good mountaineers and trekking guides. Many of Tamang have been recruited to serve in Indian and British Gurkha regiments since British Raj.') ?> 
<br/><br/>
<?php echo __('The Tamang generally follow Tibetan Buddhism mixed with elements of the pre-Buddhist Bön and the Tambaist religion. Due to their proximity to the Newar, a slight Hindu influence can be seen in their practices. According to the 2001 census, 88.26% of the ethnic Tamang in Nepal were Buddhists and 7.69% were Hindus. The typical song and dance of the Tamangs is "tamang selo" in which they dance to the beat of a drum called "damphu." Damphu is the traditional drum of the Tamangs.') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<h2 id="kunchusum"><?php echo ++$counter; ?>. <?php echo __('Kunchusum') ?></h2>
<?php echo __('Kunchu means "Divine Being", while Sum means "Three", thus Kunchusum is "the Three Buddha".') ?> 
<br/><br/>
<?php include_component('photo', 'show', array('id'=>131)); ?>
<?php echo __('Kunchusum Lhakhang is a rural looking temple, in a short distance from Tamshing Lhakhang (the most important Nyingma school temple in Bhutan). The temple dates back to 7th century, it was discovered and restored by the treasurer in 15th century. The temple is famous for its bell, which bears an inscription from the 8th century. It was stolen from Tibet and transported to Bhutan. Perhaps the Tibetan Royal Family had cats which could hear the "sound of Buddhism".') ?> 
<a href="#up" class="to_top"><?php echo __('Go to top') ?></a>
<br/><br/>
<br/>
<?php include_component('comments', 'show'); ?>	