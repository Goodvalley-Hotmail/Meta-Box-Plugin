<!-- It's just HTML. Our View for the MetaBox is just a Form built with HTML. -->
<!-- We need an <input> with type "text". -->
<!-- Then, the name of the input will be our Meta Key, in this case "subtitle". -->
<!-- The other thing that goes with an input is a label. -->
<!-- We'll also put a usage instruction. WordPress comes with a built-in class for that called "description". -->

<!-- So how we build our Form is up to us. We can make a Table or whatever we may choose. -->
<p>
	<label for="subtitle">Subtitle</label>
	<!-- To build a box that covers the screen's length, WordPress has a built-in class part of the interface styling called "large-text". -->
	<input class="large-text" type="text" name="subtitle" value="">
	<span class="description">Enter the SubTitle for this piece of Content.</span>
</p>