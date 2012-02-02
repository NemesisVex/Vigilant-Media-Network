<h2>Signal Flow</h2>

<p>The general signal flow for the hardware keyboards works like so:</p>

<ul> <li> Cakewalk SONAR sends MIDI signal to the hardware keyboards via the MIDI interface.</li>
	<li> The keyboards are hooked up to the mixer, which combines all the audio signals from the hardware instruments together.</li>
	<li> The output of the mixer is fed to the input of the external sound card.</li>
	<li> The signal from the external sound card is fed back into Cakewalk SONAR and recorded to digital audio.</li>
	<li> The digital audio can then be mixed with audio from software synthesizer outputs.</li>
</ul>

<p>Here's the same signal flow with a few more specifics.</p>

<ul> <li> Cakewalk SONAR sends MIDI signal to the hardware keyboards via the MIDI interface.
		<ul>
			<li> The MIDI signal sent to Port A of the M-Audio Midisport is received by the Kurzweil PC-88.</li>
			<li> The MIDI signal sent to Port B of the M-Audio Midisport is received by the Korg N364.</li>
			<li> The MIDI signal sent to Port C of the M-Audio Midisport is received by the Kawai K4.</li>
			<li> The Kurzweil PC-88 or the Korg N364 can both send signal to Cakewalk SONAR.</li>
		</ul>
	</li>
	<li> The keyboards are hooked up to the mixer, which combines all the audio signals from the hardware instruments together.
		<ul>
			<li> The Korg N364 sends audio signal to Channels 3 and 4 of the Yamaha MG10/2 mixer.</li>
			<li> The Kurzweil PC-88 sends audio signal to Channels 5 and 6 of the Yamaha MG10/2 mixer.</li>
			<li> The Kawai K-4 sends audio signal to Channels 7 and 8 of the Yamaha MG10/2 mixer.</li>
			<li> The M-Audio Delta 44 sound card sends audio signal from Outputs 1 and 2 to Channels 9 and 10 of the Yamaha MG10/2 mixer. This connection allows hardware synthesizers to be mixed with software synthesizers for monitoring.</li>
		</ul>
	</li>
	<li> The output of the mixer is fed to the input of the external sound card.
		<ul>
			<li> ST OUT of the Yamaha MG10/2 mixer is plugged into Inputs 1 and 2 of the M-Audio Delta 44 sound card.</li>
		</ul>
	</li>
	<li> The signal from the external sound card is fed back into Cakewalk SONAR and recorded to digital audio.
		<ul>
			<li> Audio tracks in SONAR should accept signal from <strong>Stereo M-Audio Delta ASIO Analog In 1/2 Delta 44</strong> and send signal to <strong>M-Audio Delta ASIO Analog Out 1/2 Delta</strong>.</li>
		</ul>
	</li>
	<li> The digital audio can then be mixed with audio from inputs within the computer.
		<ul>
			<li> To ensure a proper mix between software and hardware synthesizers, Outputs 1 and 2 of the M-Audio Delta 44 external sound card are connected to the line-in of the internal sound card. The M-Audio Delta 44 Control Panel is also set to <strong>Monitor Mixer</strong> under <strong>H/W Out 1/2</strong> of the <strong>Patchbay/Router</strong> tab.</li>
		</ul>
	</li>
</ul>

<h3>Recording a software and hardware synthesizer mix</h3>

<p>To expedite the recording process, software synthesizer tracks are bounced to audio in Cakewalk SONAR. Although Outputs 1 and 2 of the external sound card can be plugged to Inputs 9 and 10 of the mixer, this setup depends on the level of the mixer to provide signal back to Cakewalk SONAR.</p>

<p>When mixing software and hardware synthesizers for recording, the <strong>Monitor Mixer</strong> of the M-Audio Delta 44 external sound card must be deployed. The <strong>Monitor Mixer</strong> combines signals from both the input of the external sound card itself as well as input received from software, such as Reason.</p>

<p>Using the <strong>Monitor Mixer</strong> provides the ideal setting for setting levels on software synthesizer instruments.</p>

<p>To mix software and hardware synthesizers for recording:</p>

<ul>
	<li> Connect Outputs 1 and 2 of the M-Audio Delta 44 to the internal sound card of the computer.</li>
	<li> Set the M-Audio Delta 44 Control Panel to <strong>Monitor Mixer</strong>.</li>
</ul>

<h3>Recording vocals</h3>

<p>To record vocals, the mixer should send no signal to the computer but input from the microphone. At the same time, a singer must monitor the background music to deliver a performance. To allow the mixer to handle both tasks, all signal from the keyboards and the computer must be muted while being routed to an auxiliary send. The singer can then listen to the background music, as well as his or her own performance, through headphones connected to that auxiliary send.</p>

<p>The mixer and sound cards should follow this setup to record vocals:</p>

<ul>
	<li> Channel 1:
		<ul>
			<li> Connect microphone to XLR input.
			<li> Connect Alesis compressor to Insert/IO with a special Y-connector containing a balanced TRS jack on one end and a pair of unbalanced TS jacks on the other end.
			<li> Set mic preamp to level appropriate to microphone. This step requires a manual test.
			<li> Set level to 7.
			<li> Set Aux Send to left (Aux 1), which sends the signal to the monitor headphones.
		</ul>
	<li> Channel 2:
		<ul>
			<li> Set level to 0. This channel is not used.
		</ul>
	<li> Channels 3 and 4:
		<ul>
			<li> Set level to 0.
		</ul>
	<li> Channels 5 and 6:
		<ul>
			<li> Set level to 0.
			<li> If a vocal guide is played on the Kurzweil PC-88, set Aux Send to left (Aux 1) until it's loud enough in the headphones.
		</ul>
	<li> Channels 7 and 8:
		<ul>
			<li> Set level to 0.
		</ul>
	<li> Channels 9 and 10:
		<ul>
			<li> Connect Outputs 1 and 2 of the external sound card to Channels 9 and 10.
			<li> Set level to 0.
			<li> Set Aux Send to left (Aux 1) until it's loud enough in the headphones.
			<li> Set the <strong>H/W Out 1/2</strong> setting of the M-Audio Delta Control Panel to <strong>WaveOut 1/2</strong>.
			<li> Mute the Line-In of the internal sound card.
		</ul>
	<li> Set C-R/Phones level to 0.
</ul>

<p>With this setup, the signal of the microphone follows this path:</p>

<ul>
	<li> Microphone signal goes to Alesis compressor and back again through Insert/IO.
	<li> Channel 1 signal goes to mic preamp.
	<li> Channel 1 signal is sent from the mixer to Inputs 1 and 2 of the external sound card.
	<li> Inputs 1 and 2 signal is received by Cakewalk SONAR.
	<li> Cakewalk SONAR send Inputs 1 and 2 to Outputs 1 and 2 of the external sound card.
	<li> Outputs 1 and 2 of the external sound card is sent back to Channels 9 and 10 of the mixer.
	<li> Channels 9 and 10 of the mixer are sent to Aux Send 1, where headphones are connected.
</ul>

<p>To listen to recorded vocals through the mixer:</p>

<ol>
	<li> Turn up Channels 9 and 10 of the mixer.
	<li> Turn up C-R/Phones.
</ol>

<p>To listen to recorded vocals through the computer speakers:</p>

<ol>
	<li> Connect Output 3 and 4 of the external sound card to the internal sound card of the computer.</li>
	<li> Unmute the Line In of the internal sound card.
	<li> In Cakewalk SONAR, set the audio output of the track to M-Audio Delta Outputs 3 and 4.
</ol>
